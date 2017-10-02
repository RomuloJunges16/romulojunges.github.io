<?php

interface IRequestValidator {


	public function isMethodValid($method);

	public function isProtocolValid($protocol);

	public function isUriValid($uri);

	public function isQueryStringValid($queryString);
	
	public function isBodyValid($body);
}