<?php

require_once ("model/user.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class UserController {

	private $allowedOperations = Array('info', 'register');
	private $request;
	
	public function __construct($request) {
		$this->request = $request;
	}			  

	public function routeOperation() {
		$userBody = json_decode($this->request->getBody(),true);
		//print_r($userBody);

		switch($this->request->getOperation()) {

			case 'register':
				if($this->request->getMethod() == "POST")
						return $this->create($userBody);
					return (new RequestException(400, "Bad request"))->toJson();

			case 'info':
				if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString());
					return (new RequestException(400, "Bad request"))->toJson();
			default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($userBody) { 	
		try{ 	
		 	new User($userBody["name"], $userBody["login"], $userBody["email"], $userBody["pass"], $userBody["status"]);
		 	return (new DBHandler())->insert($userBody, 'colUser');//nome da collection no meu mongo LOCAL
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString, 'colUser'); //nome da collection no meu mongo LOCAL
	}

}
