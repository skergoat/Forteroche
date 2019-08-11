<?php

namespace Model;

use \PDO;

class Manager 
{

	protected $bdd;

	public function __construct()
	{
		$this->bdd = new \PDO('mysql:host=concombre.o2switch.net;dbname=skergoat_forteroche;charset=utf8', 'skergoat', '919528565x9?securite', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));   
	} 

	public function getManager() {
		
		return $this->bdd;  	

	}

}