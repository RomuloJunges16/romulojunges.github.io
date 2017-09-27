<?php

require_once ("interface/IrequestValidator.php");

class RequestValidator implements IrequestValidator
{
	//ARRAY QUE CONTEM TODAS OS METODOS QUE O SISTEMA ACEITA
	private $allowedMethods = Array('GET', 'PUT', 'POST');

	//ARRAY QUE CONTEM ARRAYS QUE POSSUEM AS URIS QUE O SISTEMA ACEITA
	private $allowedUris = Array(
								'users' 	=> Array('register', 'info', 'update'),
								'champs' 	=> Array('register', 'info', 'registerTeam', 'update'),
								'news' 		=> Array('register', 'read', 'update'),
								'admin'		=> Array('controlUser', 'controlChamps', 'controlNews')
								);

	public function isMethodValid($method)
	{
		//VERIFICA SE O METODO PASSADO CONTEM NO ATRIBUTO ALLOWEDMETHODS
		if(!in_array($method, $this->allowedMethods))
			return false;
		return true;
	}

	public function isProtocolValid($protocol)
	{
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

	public function isUriValid($uri)
	{
		//PEGA A URI PASSADA E COLOCA EM UM ARRAY
		$arrayUri = explode('/', $uri);

		//VERIFICA SE O VALOR NA POSIÇÃO 2 DA URI PASSADA ESTA NA ALLOWEDURIS DE ACORDO COM A POSIÇÃO 1
		//EX: $arrayUri[1] = users | $arrayUri[2] = register, ELE VERIFICA SE A ARRAY COM INDICE users POSSUE O register
		if(!in_array($arrayUri[2], $this->allowedUris[$arrayUri[1]]))
			return false;
		return true;
	}

	public function isQueryStringValid($queryString)
	{

	}
	
	public function isBodyValid($body)
	{

	}	
}