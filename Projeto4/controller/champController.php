<?php

require_once ("model/champ.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class ChampController
{
	private $allowedOperations = Array('register', 'info', 'registerTeam', 'update');
	private $request;

	public function __construct($request)
	{
		echo "ENTROU";
		$this->request = $request;
	}

	public function routeOperation()
	{
		$champsBody = json_decode($this->request->getBody(), true);

		switch($this->request->getOperation()) {

			case 'register':
				if($this->request->getMethod() == "POST")
						return $this->create($champsBody);
					return (new RequestException(400, "Bad request"))->toJson();

			case 'info':
				if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString());
					return (new RequestException(400, "Bad request"))->toJson();
			default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}

	private function create($champsBody)
	{
		try
		{
			new Champ($champsBody["name"], $champsBody["game"], $champsBody["description"], $champsBody["numberTeams"], $champsBody["dateStart"], $champsBody["userOwner"], $champsBody["status"]);
			return (new DBHandler())->insert($champsBody, 'colChamps');//nome da collection no meu mongo LOCAL
		}
		catch(RequestException $ue)
		{
			return $ue->toJson();
		}
	}

	private function search($queryString)
	{
		return (new DBHandler())->search($queryString, 'colChamps');//nome da collection no meu mongo LOCAL
	}
}

