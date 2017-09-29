<?php

require_once("validation/newsValidator.php");
require_once("exception/requestException.php");

class News
{

	private $img;
	private $title;
	private $text;
	private $date;

	private $nv;

	public function __construct($img, $title, $text, $date)
	{
		$this->nv = new NewsValidator();
		$this->setImg($img);
		$this->setTitle($title);
		$this->setText($text);
		$this->setDate($date);
	}

	public function setImg($img)
	{
		$this->img = $img;		
	}

	public function setTitle($title)
	{
		if(!$this->nv->isTitleValid($title))
		{
			throw new RequestException("400", "Titulo invalido");
		}
		$this->title = $title;		
	}

	public function setText($text)
	{
		if(!$this->nv->isTextValid($text))
		{
			throw new RequestException("400", "Texto invalido");
		}
		$this->text = $text;		
	}

	public function setDate($date)
	{
		$this->date = $date;
	}
}