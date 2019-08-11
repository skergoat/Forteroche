<?php 

namespace Model\Auth;

require_once('Admin.php');

use Model\Auth\Admin;
use Model\Manager;

class AdminManager {

	/**
	* Create new mysql connection   
	**/
	protected $manager;

	public function __construct()
	{
		$this->manager = new Manager;
	}

	/**
	*  Authenticate admin 
	**/
	public function Authentication($name) {

		$manager = $this->manager->getManager();

		$messageRetour = $manager->prepare('SELECT * FROM admin WHERE name = ?') or die(print_r($manager->errorMessage())); 

		$messageRetour->execute(array($name));

		$post = $messageRetour->fetch();

		return $post;
		
	}

	/**
	* show admins list  
	**/
	public function show(){

		$admins = [];

		$manager = $this->manager->getManager(); 

		$listAdmins = $manager->query('SELECT * FROM admin ORDER BY ID DESC') or die(print_r($manager->errorMessage()));

		while($admin = $listAdmins->fetch()){

			$admins[] = new Admin($admin);
		}

		return $admins;
	}

	/**
	* show one single admin   
	**/
	public function showAdmin($id) {

		$id = (int) $id;

		$manager = $this->manager->getManager();

		$adminRetour = $manager->prepare('SELECT * FROM admin WHERE ID = ?') or die(print_r($manager->errorMessage())); 

		$adminRetour->execute(array($id));

		$admin = $adminRetour->fetch();

		return new Admin($admin);
	}

	/**
	* existence of id in bdd    
	**/
	public function existAdmin($id) { 

		if(is_numeric($id)) { // when $id is id 

			$manager = $this->manager->getManager();

		    return (bool) $manager->query('SELECT COUNT(*) FROM admin WHERE ID = '. $id)->fetchColumn();

	    }  
	    else {				 // when $id is email 

	    	$manager = $this->manager->getManager();

		    $verify = $manager->prepare('SELECT COUNT(*) FROM admin WHERE email = ?') or die(print_r($manager->errorMessage()));
		    $verify->execute(array($id));

		    $returnVerify = $verify->fetchColumn();

		    return (bool) $returnVerify;

	    }

	}

	/** 
	* Verify if recover code and email exist in bdd 
	**/
	public function verifyRecoverCode($email, $code) {

		$manager = $this->manager->getManager();

	    $verifyCode = $manager->prepare('SELECT COUNT(*) FROM recover WHERE email = ? AND code = ?') or die(print_r($manager->errorMessage()));
	    $verifyCode->execute(array($email, $code));

	    $returnVerifyCode = $verifyCode->fetchColumn();

	    return (bool) $returnVerifyCode;

	}


	/**
	*	Remove recover code from bdd when used
	**/
	public function removeCode($recoverMail) {

		$manager = $this->manager->getManager();

		$removeCode = $manager->prepare('DELETE FROM recover WHERE email = ?') or die(print_r($bdd->errorMesssage()));

		$removeCode->execute(array($recoverMail));
	}


	/**
	*	Remove codes after five minutes if not used  
	**/
	public function removeCodeAfter() {

		$manager = $this->manager->getManager();

		$manager->query('DELETE FROM recover WHERE NOW() > date_destroy') or die(print_r($bdd->errorMesssage()));
	}


	/** 
	* Verify if credentials are unique in bdd
	**/

	function verifInfo(){

		$manager = $this->manager->getManager();

		$reponse = $manager->query('SELECT * FROM admin') or die(print_r($bdd->errorMesssage()));

		return $reponse;
	}

	/** 
	* When updating admin, verify if credentials are unique in bdd in exclusion of those we want to update
	**/
	function verifUpdateInfo($id) {

		$manager = $this->manager->getManager();

		$reponse = $manager->query('SELECT * FROM admin WHERE ID <>' . $id) or die(print_r($bdd->errorMesssage()));

		return $reponse;
	}

	/**
	* Store recover code 
	**/
	function storeCode($mail, $code) {

		$manager = $this->manager->getManager();

		$storeCode = $manager->prepare('INSERT INTO recover(email, code, date_init, date_destroy) VALUES(?, ?, NOW(), DATE_ADD(date_init, INTERVAL 5 MINUTE))') or die(print_r($manager->errorMessage()));

		$storeCode->execute(array($mail, $code));
	}

	/**
	*	Get code list 
	**/
	function listCodes() {

		$manager = $this->manager->getManager();

		$listeCode = $manager->query('SELECT * FROM recover') or die(print_r($manager->errorMessage()));

		return $listeCode; 
	}

	/**
	*	When recovering password, verify if email exists in bdd and send object  
	**/
	function recoverVerify($email) {

		$manager = $this->manager->getManager();

		$reponse = $manager->prepare('SELECT * FROM admin WHERE email = ?') or die(print_r($bdd->errorMesssage()));

		$reponse->execute(array($email));

		$email = $reponse->fetch();

		return new Admin($email);
	}

	/**
	* store admin  
	**/
	public function store($name, $password, $email){

		$manager = $this->manager->getManager();

		$store = $manager->prepare('INSERT INTO admin(name, password, email) VALUES(?, ?, ?)') or die(print_r($manager->errorMessage()));

		$store->execute(array($name, $password, $email)); 
	}

	/**
	* Return the id of the last admin stored
	**/
	public function maxID(){

		$manager = $this->manager->getManager();

		$admin = $manager->query('SELECT MAX(ID) FROM admin') or die(print_r($manager->errorMessage())); 

		$maxId = $admin->fetch(); 

		return $maxId; 
	}

	/**
	* update admin  
	**/
	public function updateAuth($id, $name, $email){

		$manager = $this->manager->getManager();

		$update = $manager->prepare('UPDATE admin SET name = ?, email = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$update->execute(array($name, $email, $id)); 
	}

	/**
	* update password  
	**/
	public function newPassword($password, $id) {

		$manager = $this->manager->getManager();

		$updatePass = $manager->prepare('UPDATE admin SET password = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$updatePass->execute(array($password, $id));
	}

	/**
	* delete admin 
	**/
	public function delete($id) {

		$manager = $this->manager->getManager();

		$destroyAdmin = $manager->prepare('DELETE FROM admin WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$destroyAdmin->execute(array($id)); 
	}

}