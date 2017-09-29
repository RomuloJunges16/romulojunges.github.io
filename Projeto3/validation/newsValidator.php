<?php

class NewsValidator
{
	public function isTitleValid($title)
	{
		if(empty($title))
			return false;
		return true;
	}

	public function isTextValid($text)
	{
		if(empty($text))
			return false;
		return true;
	}
}