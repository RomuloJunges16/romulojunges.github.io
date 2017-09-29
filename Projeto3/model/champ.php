<?php

require_once("validation/champValidator.php");
require_once("exception/requestException.php");

class Champ
{
	private $name;
	private $game;
	private $description;
	private $numberTeams;
	private $dateStart;
	private $userOwner;
	private $status;

	private $cv;

	public function __construct($name, $game, $description, $numberTeams, $dateStart, $userOwner, $status)
	{
		$this->cv = new ChampValidator();
		$this->setName($name);
		$this->setGame($game);
		$this->setDescription($description);
		$this->setNumberTeams($numberTeams);
		$this->setDateStart($dateStart);
		$this->setUserOwner($userOwner);
		$this->setStatus($status);
	}

	public function setName($name)
	{
		if(!$this->cv->isNameValid($name))
		{
			throw new RequestException("400", "Nome invalido");
		}
		$this->name = $name;
	}

	public function setGame($game)
	{
		if(!$this->cv->isGameValid($game))
		{
			throw new RequestException("400", "Escolha um game");
		}
		$this->game = $game;		
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function setNumberTeams($numberTeams)
	{
		if(!$this->cv->isNumberTeamsValid($numberTeams))
		{
			throw new RequestException("400", "So é aceito numeros");
		}
		$this->numberTeams = $numberTeams;		
	}

	public function setDateStart($dateStart)
	{
		$this->dateStart = $dateStart;
	}

	public function setUserOwner($userOwner)
	{
		if(!$this->cv->isUserOwnerValid($userOwner))
		{
			throw new RequestException("400", "Necessario ter um criador do campeonato");
		}
		$this->userOwner = $userOwner;
	}

	public function setStatus($status)
	{
		$status = 1;
		$this->status = $status;
	}
}