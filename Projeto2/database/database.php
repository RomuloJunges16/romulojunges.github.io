<?php

class DBHandler
{
	//DECLARA UMA CONSTANTE PRO NOME DO BANCO DE DADOS
	const DB_NAME = "test";

	public function getConnection() 
	{
		try 
		{
			//TENTA FAZER A CONEXAO COM O BANCO DE DADOS
		    $mng = new MongoDB\Driver\Manager("mongodb://admin:123456@localhost:27017");

		    return $mng;

		} 
		catch (MongoDB\Driver\Exception\Exception $e) 
		{		    
		    return json_encode(
		    			 	Array(
		    			 		"msg"  => $e->getMessage(), 
		    			 		"file" => $e->getFile(), 
		    			 		"line" => $e->getLine()
		    			 	));       
		}
	}

	public function insert($document, $collection) 
	{
		//FAZ A CONEXAO COM O BANCO DE DADOS
		$conn = $this->getConnection();

		//CRIA A CLASSE BULKWRITE QUE ESCREVE NO BANCO DE DADOS
		$bulk = new MongoDB\Driver\BulkWrite;

		//INSERE NA VARIAVEL $BULK O DOCUMENTO PASSADO PELO BODY
		$bulk->insert($document);
		
		//EXECUTA A INSERCAO NO BANCO DE DADOS
		$result = $conn->executeBulkWrite(
										"test.".$collection,
										 $bulk);
		return $result;
	}

	public function search($parameters) 
	{
		//FAZ A CONEXAO COM O BANCO DE DADOS
		$conn = $this->getConnection();

		//CRIA A QUERY DO MONGODB PASSANDO OS PARAMETROS PRA PROCURAR
		$query = new MongoDB\Driver\Query($parameters, []);

		//EXECUTA A QUERY NO BANCO
		$rows = $conn->executeQuery("test.users", $query);

		//RESULTADO DA BUSCA
		$result = Array();
			foreach ($rows as $row) 
			{ 
	        	array_push($result, $row);
	    	}

		return json_encode($result);
	}
}