<?php

require_once ("model/request.php");
require_once ("validation/requestValidator.php");
require_once ("controller/usercontroller.php");

class RequestTreater 
{
	//ARRAY COM TODOS OS CONTROLADORES PARA CADA POSIÇÃO DA URI[1]
	private $controllers = Array(
								"users" 	=> "UserController",
								"champs" 	=> "ChampController",
								"news" 		=> "NewsController",
								"admin"		=> "AdminController"
								);

	//FUNÇÃO QUE CRIA O OBJETO REQUEST E ATRAVES DE ROTAS LEVA PARA CADA CONTROLADOR PASSANDO OS RECURSOS NA ROTA
	public function start() 
	{
		try
		{	
			$request = new Request(	$_SERVER['REQUEST_METHOD'],
						   			$_SERVER['SERVER_PROTOCOL'], 
						   			$_SERVER['HTTP_HOST'], 
						   			$_SERVER['REQUEST_URI'], 
						   			$_SERVER['QUERY_STRING'],
						   			file_get_contents('php://input')
						   			);
		
			$controller = new $this->controllers[$request->getResource()]($request);
			return $controller->routeOperation();
	
		}
		catch(RequestException $re) 
		{
			return $re->toJson();
		}

	
	}
}