<?php

namespace Model;

use \PDO;

class Manager 
{

	protected $bdd;

	public function __construct()
	{
		$this->bdd = new \PDO('mysql:host=your_provider;dbname=your_database;charset=utf8', '', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));   
	} 

	public function getManager() {
		
		return $this->bdd;  	

	}

}
