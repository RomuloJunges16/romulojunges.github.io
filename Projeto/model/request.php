<?php

require_once ("validation/requestValidator.php");
require_once ("exception/requestException.php");

class Request
{

	//ATRIBUTOS PARA CRIAR O OBJETO REQUEST
	private $method;
	private $protocol;
	private $host;
	private $uri;
	private $queryString;
	private $body;
	private $resource;
	private $operation;
	//ATRIBUTO PRA SALVAR A INSTANCIA DO REQUESTVALIDATOR
	private $rv;

	public function __construct($method, $protocol, $host, $uri = null, $queryString = null, $body = null)
	{
		//CRIANDO A INSTANCIA DO REQUEST VALIDATOR E SALVANDO NA VARIAVEL RV
		$this->rv = new RequestValidator();

		//FAZENDO A VALIDAÇÃO ANTES DE SETAR O VALOR NA VARIAVEL
		$this->setMethod($method);
		$this->setProtocol($protocol);
		$this->host = $host;
		$this->setUri($uri);
		$this->queryString = $queryString;
		$this->body = $body;
		$this->setResource();
		$this->setOperation();
	}

	public function getMethod()
	{
		return $this->method;
	} 

	public function getPath()
	{
		return $this->path;
	} 

	public function getBody(){
		return $this->body;
	}

	public function getResource()
	{
		return $this->resource;
	}

	public function getOperation() 
	{
		return $this->operation;
	}

	private function setMethod($method) 
	{
		//ANTES DE SETAR NA VARIAVEL ELE FAZ A VALIDAÇÃO
		if(!$this->rv->isMethodValid($method))
			throw new RequestException("405", "Método não permitido");
		$this->method = $method;
	}

	private function setProtocol($protocol)
	{
		//ANTES DE SETAR NA VARIAVEL ELE FAZ A VALIDAÇÃO
		if(!$this->rv->isProtocolValid($protocol))
			throw new RequestException("505", "Protocolo não permitido");
		$this->protocol = $protocol;	
	}	

	private function setUri($uri) 
	{
		//ANTES DE SETAR NA VARIAVEL ELE FAZ A VALIDAÇÃO
		if(!$this->rv->isUriValid($uri))
			throw new RequestException("404", "Objeto não encontrado");
		$this->uri = $uri;
	}

	private function setQueryString($queryString)
	{
		//ANTES DE SETAR NA VARIAVEL ELE FAZ A VALIDAÇÃO
		if(!$this->rv->isQueryStringValid($queryString))
			throw new RequestException("406", "Query String não permitida");
		$this->queryString = $queryString;
	}

	private function setResource() 
	{
		//COLOCA A URI EM ARRAY E PEGA O RESULTADO DA POSICAO 1 PRA VALIDAR
		$uri = explode("/", $this->uri);
		$this->resource = $uri[1];
	}

	private function setOperation() 
	{
		//COLOCA A URI EM ARRAY E PEGA O RESULTADO DA POSICAO 2 PRA VALIDAR
		$uri = explode("/", $this->uri);
		$this->operation = $uri[2];
	}	

}