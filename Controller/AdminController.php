<?php

namespace Controller;

require_once('Model/Auth/AdminManager.php');
require_once('Services/notificationMail.php');

use Model\Auth\AdminManager;
use Services\NotificationMail;


class AdminController 
{	

	/**
	* show auth page
	**/
	public function admin() {

		require('view/Back/Admin/admin.php');
	} 

	/**
	* Sign in 
	**/
	public function auth($nom, $password){

		$admin = new AdminManager;
		$messageRetour = $admin->Authentication($nom);

		$isPasswordCorrect = password_verify($password, $messageRetour['password']);

		if($messageRetour && $isPasswordCorrect) {

			$_SESSION['admin'] = 'auth';				// allow user to have access to admin interface  

			$_SESSION['id'] = $messageRetour['ID'];		// help to control that current admin has the wright to 
														// manage the blog.
														// will be used each time a page is required or an action is triggered

			return true;								// indication for ajax 
		} 

		else { 

			return false;  								
		}
	}

	/**
	* Logout 
	**/
	public function logout(){

		session_start();

		$_SESSION = array();
		session_destroy();

		header('Location:/projet_4/');
	}

	/**
	* show recover page
	**/
	public function recover() {

		require('view/Back/Admin/Recover.php');
	}  

	/**
	* send recover email
	**/
	public function postRecover($email) {

		$recover = new AdminManager;
		$code = (rand()*8);

		if(preg_match('#[a-z0-9._-]{1,10}@[a-z0-9._-]{1,10}\.[a-z]{1,3}#isU', $email)) {

			$recoverPassword = $recover->existAdmin($email);

			if($recoverPassword) {

				$mail = new NotificationMail;

				$messageTxt = "Mot de Passe Votre code de réinitialisation est le : ";
				$messageHtml = "<html><head></head><body><h2>Mot de Passe</h2>Votre code de réinitialisation est le : " . $code . "</body></html>";

				$sendMail = $mail->sendNotification($email, $messageTxt, $messageHtml);

				if($sendMail) {

					$recover->storeCode($email, $code); 

					$_SESSION['recoverMail'] = $email;
					$_SESSION['recoverCode'] = $code;

					return 'success';					// mail sent 
				}
				else {

					return 'error';
				}
										
			}

			else {

				return 'nonRegistered';					// unknown email 
			}

		}
		else {

			return 'invalidRecoveredMail'; 				// invalid email
		}

	}

	/**
	* show recover code page
	**/
	public function recoverCode() {

		require('view/Back/Admin/recoverCode.php');

	}

	/**
	* verify if recover code is correct 
	**/
	public function verifyCode($code) {

		$recover = new AdminManager;

		$codeRecover = $recover->verifyRecoverCode($_SESSION['recoverMail'], $code);

		if($codeRecover) {

			return true;
		}
		else {

			return false;
		}
	
	}

	/**
	* show new password page
	**/
	public function recoverPassword() {

		$recoverPass = new AdminManager;

		$passRecovered = $recoverPass->recoverVerify($_SESSION['recoverMail']);

		require('view/Back/Admin/newPassword.php');

	}


	/**
	* show "create" page
	**/
	public function createAdmin(){

		$showAdmin = new AdminManager;

		if(isset($_SESSION['id'])) {

			$adminStillExists = $showAdmin->existAdmin($_SESSION['id']);

			if($adminStillExists) {

				$listAdmin = $showAdmin->show(); 

				require('view/Back/Admin/create.php');

			}
			else {

				$this->logout();
			} 
		}
		else {

			throw new \Exception('vous n\'êtes pas connecté comme admin');
		}
	}

	/**
	* store new admin
	**/
	public function storeAdmin($name, $password, $email){

		$storeAdmin = new AdminManager; 

			$adminStillExists = $storeAdmin->existAdmin($_SESSION['id']);

			if($adminStillExists) {					// if user is still registered as admin at the time he tries to store 												admin

				$name = strtolower($name);		// verify if $name or $password or $email already exist in bdd
				
				$reponse = $storeAdmin->verifInfo();

				while($donnee = $reponse->fetch()) { 


					if($name == $donnee['name']) {

						return 'similarName';
					}

					if(password_verify($password, $donnee['password'])) { 

						return 'similarPassword';
					}

					if($email == $donnee['email']) {

						return 'similarMail';
					}

				}

				if(preg_match('#^[a-zA-Z -]{2,}$#', $name)) { 											// name 

					if(strlen($password) > 7)														// password

						if(preg_match('#(?=.*[A-Z])+#', $password)) {

							if(preg_match('#(?=.*\d)+#', $password)) {

								if(preg_match('#(?=.*[\#\$\^\+\=\!\*\(\)\@\%\&\?])+#', $password)) {

									if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {	// mail 

										$password = password_hash($password, PASSWORD_DEFAULT);
										
										$newAdmin = $storeAdmin->store($name, $password, $email);
										$maxAdmin = $storeAdmin-> maxID(); 

										return $maxAdmin[0]; 					// return id of the last stored admin
																				// help to create a new admin in JS with the wright id

									}
									else {

										return 'invalidMail'; 
									}
								}
								else {

									return 'noSpecial'; 
								}

							}
							else {

								return 'noNumber'; 
							}

						}
						else {

							return 'notUpper'; 
						}
					
					else {

						return 'notEnough'; 
					}
				}
				else {

					return 'invalidName'; 
				}

			}
			else {

				return false;
			}

	}

	/**
	* show "update admin" pages
	**/
	public function updateAdmin($id, $adminaction){

		$update = new AdminManager;  

		$adminExists = $update->existAdmin($id); 
		$adminStillExists = $update->existAdmin($_SESSION['id']);

		if($adminStillExists) { 					// if user is still registered as admin at the time he tries to 													update admin

			if($adminExists) { 						 		// if admin we try to update exists in bdd

				if($adminaction == 'updateadmin')  { 		// show update info page

					$updateAuth = $update->showAdmin($id);

					require('view/Back/Admin/updateAdmin.php');
				}
				else if($adminaction == 'updatepasspage') { // show update password page

					$updateAuth = $update->showAdmin($id);

					require('view/Back/Admin/updatePassword.php');
				}
			}
			else {

				throw new \Exception('l\'admin n\'existe pas');
			}
		}
		else {

			$this->logout();
		}
		
	}


	/**
	* update one single admin
	**/
	public function storeUpdate($id, $nom, $email){

		$update = new AdminManager;  
		$adminStillExists = $update->existAdmin($_SESSION['id']);

		if($adminStillExists) {							// if user is still registered as admin at the time he tries to 												delete admin

			$adminExists = $update->existAdmin($id); 	// if admin we want to update exists in bdd

			if($adminExists) {

				$pseudo = strtolower($nom);		// verify if $name or $password or $email already exist in bdd
												// in exclusion of those we want to update 

				$reponse = $update->verifUpdateInfo($id);		


				while($donnee = $reponse->fetch()) { 

					if($nom == $donnee['name']) {

						return 'similarName';
					}

					if($email == $donnee['email']) {

						return 'similarUpdateMail';
					}

				}

				if(strlen($nom) > 1) { 											// name

					if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {	// mail 

						$updateAuth = $update->updateAuth($id, $nom, $email); 

						return 'true';
						
					}
					else {

						return 'invalidUpdateMail'; 
					}
				}
				else {

					return 'invalidName'; 
				} 
			}
			else {

				throw new \Exception('l\'admin n\'existe pas');
			}
		}
		else {

			return 'failed';
		}
			
	}



	/**
	* send recovered password
	**/
	public function recoverAndChange($id, $recoveredPass, $confirmPass) {

		$sendNewPass = new AdminManager;

		$reponse = $sendNewPass->verifInfo();	// verify if $password or $email already exist in bdd	


		while($donnee = $reponse->fetch()) { 

			if(password_verify($recoveredPass, $donnee['password'])) { 

				return 'similarPassword';
			}

		}

		if(strlen($recoveredPass) > 7)														// password

			if(preg_match('#(?=.*[A-Z])+#', $recoveredPass)) {

				if(preg_match('#(?=.*\d)+#', $recoveredPass)) {

					if(preg_match('#(?=.*[\#\$\^\+\=\!\*\(\)\@\%\&\?])+#', $recoveredPass)) {

						if($recoveredPass == $confirmPass) {

							$sendNewPass->removeCode($_SESSION['recoverMail']);

							session_destroy();

							$Pass = password_hash($recoveredPass, PASSWORD_DEFAULT);
							$test = $sendNewPass->newPassword($Pass, $id);

							return 'success';

						}
						else {

							return 'failed';
							
						}

					}
					else {

						return 'noSpecial'; 
					}

				}
				else {

					return 'noNumber'; 
				}

			}
			else {

				return 'notUpper'; 
			}
		
		else {

			return 'notEnough'; 
		}
		

	}


	/**
	* update admin password
	**/

	public function updatePassword($id, $nom, $formerPassword, $password) {

		$newPass = new AdminManager;
		$reponsePass = $newPass->Authentication($nom);
		$isPasswordCorrect = password_verify($formerPassword, $reponsePass['password']);

		if($isPasswordCorrect) {

			$reponse = $newPass->verifInfo();			// verify if $name or $password or $email already exist in bdd

			while($donnee = $reponse->fetch()) { 		

				if(password_verify($password, $donnee['password'])) { 

					return 'similarPassword';			// indications for ajax 
				}

			}

			if(strlen($password) > 7) {

				if(preg_match('#(?=.*[A-Z])+#', $password)) {

					if(preg_match('#(?=.*\d)+#', $password)) {

						if(preg_match('#(?=.*[\#\$\^\+\=\!\*\(\)\@\%\&\?])+#', $password)) {

							$password = password_hash($password, PASSWORD_DEFAULT);
							$newPass->newPassword($password, $id); 

							
							return 'success';

						}
						else {

							return 'noSpecial'; 
						}

					}
					else {

						return 'noNumber'; 
					}

				}
				else {

					return 'notUpper'; 
				}
			}
			else {

				return 'notEnough'; 
			}							 
		}
		else {

			return 'failed';							
		}

	}


	/**
	* delete single admin
	**/
	public function deleteAdmin($id)
	{
		$deleteAdmin = new AdminManager;
		$adminStillExists = $deleteAdmin->existAdmin($_SESSION['id']);

		$adminExists = $deleteAdmin->existAdmin($id); 


		if($adminStillExists) {							// if user is still registered as admin at the time he tries to 												delete admin

			if($adminExists) { 							// if admin we try to delete exists in bdd 

				$endAdmin = $deleteAdmin->delete($id);
				
			}
			else {

				throw new \Exception('l\'admin n\'existe pas');
			}
		}
		else {

			$this->logout();
		}
	 
	}

}



