<?php

namespace Model\Thema;

use Model\Manager;
use Model\Thema\Themas;

require_once('Model/Manager.php');
require_once('Themas.php');


class ThemasManager
{
	/**
	* Create new mysql connection  
	**/
	protected $manager;

	public function __construct()
	{
		$this->manager = new Manager;
	}

	/**
	*	Store new thema 
	**/
	public function storeThema($thema){ 

		$manager = $this->manager->getManager(); 

		$store = $manager->prepare('INSERT INTO Thema(theme_label) VALUES(?)') or die(print_r($manager->errorMessage()));
		$store->execute(array($thema));

		return true;  
	}

	/**
	*	Get Id of last thema created 
	**/
	public function maxThemaID() {

		$manager = $this->manager->getManager();

		$themaID = $manager->query('SELECT MAX(ID) FROM Thema') or die(print_r($manager->errorMessage())); 

		$maxThId = $themaID->fetch(); 

		return $maxThId;
	}


	/**
	*	Show thema list on update page 
	**/
	public function showThemas() {

		$themas = [];

		$manager = $this->manager->getManager(); 

		$show = $manager->query('SELECT * FROM Thema ORDER BY id ASC') or die(print_r($manager->errorMessage()));

		while($shows = $show->fetch()){

			$themas[] = new Themas($shows);
		}

		return $themas;
	}

	/**
	* Create thema for post 
	**/
	public function createThemePost($id, $theme) {

		$manager = $this->manager->getManager(); 

		$post = $manager->prepare('UPDATE posts SET theme_id = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));
		$post->execute(array($theme, $id));

		return true; 
	}


	/**
	* Delete thema 
	**/
	public function destroyThema($id) {

		$manager = $this->manager->getManager();

		$delete = $manager->prepare('DELETE FROM Thema WHERE ID = ?') or die(print_r($manager->errorMessage()));
		$delete->execute(array($id));

		$deleteFromPost = $manager->prepare('UPDATE posts SET theme_id = 0 WHERE theme_id = ?') or die(print_r($manager->errorMessage()));
		$deleteFromPost->execute(array($id));

		return true;  

	}
		
}