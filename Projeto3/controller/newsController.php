<?php

require_once ("model/news.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class ChampController
{
	private $allowedOperations = Array('register', 'read', 'update');
	private $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function routeOperation()
	{
		$body = json_decode($this->request->getBody(), true);
		switch($this->request->getOperation())
		{
			case 'register':
					return $this->create($body);
			case 'info':
					if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString());
					return (new RequestException("400", "Metodo não permitido"))->toJson();
			//default:
		}
	}

	private function create($body)
	{
		try
		{
			new User($body["img"], $body["title"], $body["text"], $body["date"]);
			return (new DBHandler())->insert($body, 'news');
		}
		catch(RequestException $ue)
		{
			return $ue->toJson();
		}
	}

	private function search($body)
	{
		return (new DBHandler())->search($queryString);
	}
}

