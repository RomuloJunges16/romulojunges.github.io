<?php

require_once ("model/user.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class UserController
{
	private $allowedOperations = Array('register', 'info', 'invite' 'update');
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
						return $this->search($body);
					return (new RequestException("400", "Metodo não permitido"))->toJson();
		}
	}

	private function create($body)
	{
		try
		{
			new User($body["name"], $body["login"], $body["email"], $body["pass"], $body["status"]);
			return (new DBHandler())->insert($body, 'users');
		}
		catch(RequestException $ue)
		{
			return $ue->toJson();
		}
	}

	private function search($body)
	{
		return (new DBHandler())->search();
	}
}