<?php

include_once "IrequestValidator.php";

class RequestValidator implements IRequestValidator 
{
	private $allowedMethods = Array('GET', 'PUT', 'POST');

	private $allowedUris = 
			Array('users'   => Array('info', 'register'),
				  'champs' 	=> Array('register', 'info', 'registerTeam', 'update'),
				  'news' 	=> Array('register', 'info', 'update'),
				  'groups'  => Array('create', 'members', 'info')
				  );

	public function isUriValid($uri) {
		$arrayUri = explode('/', $uri);
		print_r($arrayUri);

		//verificar se arrayUri[2] é chave
		if(!in_array($arrayUri[2], $this->allowedUris[$arrayUri[1]]))
			return false;
		
		return true;		
	}

	public function isMethodValid($method) {

		if(!in_array($method, $this->allowedMethods)) 
			return false;

		return true;		
	}

	public function isProtocolValid($protocol) {
		//VERIFICA SE O PROCOLO PASSADO CONTEM "HTTP" OU "HTTPS"
		if(strpos($protocol, "HTTP") !== false || strpos($protocol, "HTTPS") !== false)
		{
			return true;
		} 
		else 
		{
			return false;
		}		
	}

	

	public function isQueryStringValid($qs) {
		
	}

	public function isBodyValid($body) {
		
	}
}