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
		$this->setQueryString($queryString);
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

	public function getBody()
	{
		return $this->body;
	}

	public function getQueryString() 
	{
		return $this->queryString;
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

	private function setQueryString($queryString) {
		//ANTES DE SETAR ELE EXPLODE A QUERY STRING NO & CASO VENHA MAIS PARAMETROS NA QUERYSTRING E DEPOIS SERA EM CHAVE E VALOR NO "=" E TRANSFORMA EM ARRAY
		$finalQueryString = Array();
		
		if(!empty($queryString)){
			$queryArray = explode('&', $queryString);

			foreach ($queryArray as $value) {
				$a = explode('=', $value);
				$finalQueryString[$a[0]] = $a[1];
			}
		}	
		
		$this->queryString = $finalQueryString;
	}	

	private function setUri($uri) 
	{
		$cleanUri = explode('?', $uri);

		//ANTES DE SETAR NA VARIAVEL ELE FAZ A VALIDAÇÃO
		if(!$this->rv->isUriValid($cleanUri[0]))
			throw new RequestException("404", "Objeto não encontrado");
		$this->uri = $cleanUri[0];
	}

	private function setQueryString($queryString) 
	{
		$finalQueryString = Array();
		
		if(!empty($queryString)){
			$queryArray = explode('&', $queryString);

			foreach ($queryArray as $value) {
				$a = explode('=', $value);
				$finalQueryString[$a[0]] = $a[1];
			}
		}	
		
		$this->queryString = $finalQueryString;
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