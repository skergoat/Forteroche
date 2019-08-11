<?php 

namespace Controller;

use Controller\AdminController;
use Model\Auth\AdminManager;
use Model\Thema\ThemasManager;

require_once('Model/Thema/ThemasManager.php');
require_once('Model/Auth/AdminManager.php');
require_once('Controller/AdminController.php');


class ThemaController 
{

	/**
	*	Create Thema 
	**/
	public function storeThema($thema) {

		$admin = new AdminManager; 
		$adminStillExists = $admin->existAdmin($_SESSION['id']);

		if($adminStillExists) {	

			$storeManager = new ThemasManager; 
			$storeVerif = $storeManager->storeThema($thema);			// store in thema table

			$maxThema = $storeManager->maxThemaID();


			if($storeVerif) {

				return $maxThema[0]; 
			}
			else {

				throw new \Exception('probleme de database');
			}
		}
	}

	/**
	*	create theme for a post 
	**/
	public function postTheme($id, $theme) {

		$admin = new AdminManager; 
		$adminStillExists = $admin->existAdmin($_SESSION['id']);

		if($adminStillExists) {	

			$postManager = new ThemasManager;
			$postReturn = $postManager->createThemePost($id, $theme);

			return $postReturn;
		}
		else {

			header('Location: index.php?logout'); 
		}
	}

	/**
	* show index
	**/
	public function index() {

		$indexManager = new ThemasManager;
		$index = $indexManager->showThemas();

		return $index;
	}

	/**
	*	Show List Themas on update page 
	**/
	public function showListThemas($id) {

		$showManager = new ThemasManager;
		$showReturn = $showManager->showThemas();

		return $showReturn;
	}

	/**
	*	Delete Thema 
	**/
	public function deleteThema($id){

		$admin = new AdminManager; 
		$adminStillExists = $admin->existAdmin($_SESSION['id']);

		if($adminStillExists) {	

			$deleteManager = new ThemasManager;
			$deleteReturn = $deleteManager->destroyThema($id);

			if($deleteReturn) {

				return true; 
			}
			else {

				throw new \Exception('probleme de database');
			}
		}
	}
}