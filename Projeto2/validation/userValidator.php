<?php

class UserValidator 
{

	public function isEmailValid($email) 
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;
		return true;
	}

	public function isPassValid($pass)
	{
		//VALIDA SE A SENHA TEM MAIS DE 8 CARACTERES
		if(!strlen($pass) < 8)
			return false;
		return true;

		//VERIFICA SE A SENHA POSSUE PELO MENOS 1 NÚMERO
		if(!preg_match("#[0-9]+#", $pass))
			return false;
		return true;

		//VERIFICA SE A SENHA POSSUE PELO MENOS 1 LETRA GRANDE
		if(!preg_match("#[a-zA-Z]+#", $pass))
			return false;
		return true;
	}

	public function isNameValid($name)
	{
		//VERIFICA SE O NOME TEM NÚMERO, CASO TENHA VAI RETORNAR FALSO
		if(preg_match("~[0-9]~", $name)
			return false;
		return true;
	}

}