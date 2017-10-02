<?php

class ChampValidator
{

	public function isNameValid($name)
	{
		if(empty($name))
			return false;
		return true;
	}

	public function isGameValid($game)
	{
		if(empty($game))
			return false;
		return true;
	}

	public function isNumberTeamsValid($numberTeams)
	{
		if(!is_numeric($numberTeams))
			return false;
		return true;
	}

	public function isUserOwnerValid($userOwner)
	{
		if(empty($userOwner))
			return false;
		return true;
	}
}