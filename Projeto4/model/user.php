<?php

require_once("validation/userValidator.php");
require_once ("exception/requestException.php");

class User {
	
	private $name;
	private $login;
	private $email;
	private $pass;
	private $status;
	private $uv;

	public function __construct($name, $login, $email, $pass, $status) {
	 	$this->uv = new UserValidator();
		$this->setName($name);
		$this->setLogin($login);
		$this->setEmail($email);
		$this->setPass($pass);
		$this->setStatus($status);	
	}

	public function setName($name)
	{
		if(!$this->uv->isNameValid($name))
		{
			throw new RequestException("400", "Nome invalido");
		}
		$this->name = $name;
	}

	public function setLogin($login)
	{
		if(!$this->uv->isLoginValid($login))
		{
			throw new Exception("400", "Login invalido");	
		}
		$this->login = $login;
	}	

	public function setEmail($email) {
		if(!$this->uv->isValidEmail($email)){
			throw new RequestException("400", "Invalid email format");
		}	
		$this->email = $email;
	}

	public function setPass($pass)
	{
		if(!$this->uv->isPassValid($pass))
		{
			throw new RequestException("400", "Sua senha precisa ter 8 caracteres, pelo menos 1 número e 1 letra maiúscula");
		}
		$this->pass = $pass;
	}

	public function setStatus($status)
	{
		$status = 1;
		$this->status = $status;
	}	
}
