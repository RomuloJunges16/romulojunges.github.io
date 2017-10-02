<?php

class DBHandler {

	const DB_NAME = "dbTeste";

	public function getConnection() {
		try {

		    $mng = new MongoDB\Driver\Manager("mongodb://user:user@localhost:27017");// usuario criado para ter permissao em todos os bancos do Mongo
		    																		// localhostBypass true
		    return $mng;

		} catch (MongoDB\Driver\Exception\Exception $e) {
		    
		    return json_encode(
		    			 	Array(
		    			 		"msg"  => $e->getMessage(), 
		    			 		"file" => $e->getFile(), 
		    			 		"line" => $e->getLine()
		    			 	));       
		}
	}

	public function insert($document, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		$result = $conn->executeBulkWrite(
										"dbTeste.".$collection,
										 $bulk);
		return $result;
	}

	public function search($parameters, $collection) {
		//var_dump($parameters);
		$conn = $this->getConnection();
		$query = new MongoDB\Driver\Query($parameters, []);
		//var_dump($query);
		$rows = $conn->executeQuery("dbTeste.".$collection, $query);
		$result = Array();
		foreach ($rows as $row) {
    		
        	array_push($result, $row);
    	}
    	print_r($result);
		return json_encode($result);
	}



}