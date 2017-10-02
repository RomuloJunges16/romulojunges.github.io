<?php

require_once ("model/news.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class NewsController
{
	private $allowedOperations = Array('register', 'info', 'update');
	private $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function routeOperation()
	{
		$newsBody = json_decode($this->request->getBody(), true);
		switch($this->request->getOperation()) {

			case 'register':
				if($this->request->getMethod() == "POST")
						return $this->create($newsBody);
					return (new RequestException(400, "Bad request"))->toJson();

			case 'info':
				if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString());
					return (new RequestException(400, "Bad request"))->toJson();
			default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}

	private function create($newsBody)
	{
		try
		{
			new News($newsBody["img"], $newsBody["title"], $newsBody["text"], $newsBody["date"]);
			return (new DBHandler())->insert($newsBody, 'colNews');//nome da collection no meu mongo LOCAL
		}
		catch(RequestException $ue)
		{
			return $ue->toJson();
		}
	}

	private function search($queryString)
	{
		return (new DBHandler())->search($queryString,'colNews');//nome da collection no meu mongo LOCAL
	}
}

