<?php

/**
* Authentication
**/

// show "sign in" page

if($_GET['adminaction'] == 'admin'){

	if(isset($_SESSION['admin'])) {

		header('Location: /projet_4/index.php');
	}	
	else {

		$pageAdmin->admin();
	}

}


// show 'recover password' page

if($_GET['adminaction'] == 'recover'){

	if(isset($_SESSION['admin'])) {

		header('Location: /projet_4/index.php?adminaction=logout');
	}	
	else {

		$pageAdmin->recover();
	}
}


// send recover email

if($_GET['adminaction'] == 'postrecover'){

	if(isset($_POST['recoverMail'])) {

		if(isset($_SESSION['admin'])) {

			echo 'error';
		}
		else {

			if($_POST['recoverMail'] == NULL) {

				echo 'empty';

			} else {

				$retourMail = $pageAdmin->postRecover($_POST['recoverMail']);

				if($retourMail == 'success') {

					echo 'success';
				}
				else if ($retourMail == 'nonRegistered') {		 // mail does not exists 

					echo 'failed';
				}
				else if($retourMail == 'invalidRecoveredMail') { // invalid mail

					echo 'invalidRecoveredMail'; 
				}
				else if($retourMail == 'error') { 				// mail not sent

					echo 'error';
				}

			}
		}
	}
	else {

		throw new \Exception('index inexistants');
	}
	
}


// show "recover code" page

if($_GET['adminaction'] == 'recovercode'){

	if(isset($_SESSION['admin'])) {

		header('Location:/projet_4/index.php?adminaction=logout');
	}	
	else {

		if(isset($_SESSION['recoverMail']) && isset($_SESSION['recoverCode'])) {

			$pageAdmin->recoverCode();	
		}
		else {

			throw new \Exception('page non autorisée');
		}
	}
}


// verify code and redirect to 'new password' page

if($_GET['adminaction'] == 'verifycode'){

	if(isset($_POST['recoverCode']) && isset($_SESSION['recoverMail']) && isset($_SESSION['recoverCode'])) {

		if($_POST['recoverCode'] == NULL) {

			echo 'empty';
		}
		else {

			$recoverValid = $pageAdmin->verifyCode($_POST['recoverCode']);

			if($recoverValid) {

				echo 'success';
			}
			else {

				echo 'failed';
			}

		}

	}
	else {

		throw new \Exception('page non autorisée');
	}

}


// show "new password" page

else if($_GET['adminaction'] == 'newpasswordpage'){

	if(isset($_SESSION['admin'])) {

		header('Location: /projet_4/index.php?adminaction=logout');
	}	
	else {

		if(isset($_SESSION['recoverMail']) && isset($_SESSION['recoverCode'])) {

			$pageAdmin->recoverPassword();	
		}
		else {

			throw new \Exception('page non autorisée');
		}
	}

}


//send and update recovered password

else if($_GET['adminaction'] == 'recoverandchangepass') {

	if(isset($_SESSION['admin'])) {

		throw new \Exception('vous êtes déjà connecté');
	}
	else {

		if(isset($_POST['recoveredPass']) && isset($_POST['confirmRecoveredPass']) && isset($_GET['id'])) {

			if(is_numeric($_GET['id'])) {

				if($_POST['recoveredPass'] == NULL || $_POST['confirmRecoveredPass'] == NULL) {

					echo 'empty';
				}
				else {

					$recevoredPassword = $pageAdmin->recoverAndChange($_GET['id'], $_POST['recoveredPass'], $_POST['confirmRecoveredPass']);

					if($recevoredPassword == 'success') {

						echo 'success';
					}
					else if($recevoredPassword == 'similarPassword') {					// password already exists 

						echo 'similarPassword';
					}
					else if($recevoredPassword == 'notEnough') {						// invalid password criteria 

						echo 'notEnough';
					}
					else if($recevoredPassword == 'notUpper') {

						echo 'notUpper';
					}
					else if($recevoredPassword == 'noNumber') {

						echo 'noNumber';
					}
					else if($recevoredPassword == 'noSpecial') {

						echo 'noSpecial';
					}
					else if($recevoredPassword == 'failed') {							// passwords are not identicals

						echo 'failed';
					}
					
				}
			}
			else {

				throw new \Exception('id invalide');
			}

		}
		else {

			throw new \Exception('page non autorisée');
		}
	}
}


// Auth action 

else if($_GET['adminaction'] == 'authentication'){

	if(isset($_POST['name']) && isset($_POST['password'])) {				// isset $_POST

		if($_POST['name'] == NULL || $_POST['password'] == NULL) {			// $_POST is not NULL 

			echo 'empty';

		}
		else {

			$auth = $pageAdmin->auth(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['password']));

			if($auth == false) { 											// admin is not valid anymore

				echo 'failed';
			}

			else if($auth == true) { 										// sign in action 

				unset($_SESSION['temporary']);

				echo 'signin';
			}

		}
	}
	else {

		throw new \Exception('index inexistants');
	}
}


// logout action 

else if($_GET['adminaction'] == 'logout'){

	if(isset($_SESSION['admin'])) {											// id doesn't exists

		$pageAdmin->logout();	

	}
	else { 

		header('Location: /projet_4/index.php?adminaction=admin');
	} 	
}


// show "create" page

else if($_GET['adminaction'] == 'createadmin'){

	if(isset($_SESSION['admin'])) {	

		$pageAdmin->createAdmin();

	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}	
}


// store new admin 

else if($_GET['adminaction'] == 'storeadmin'){

	if(isset($_POST['nameAdmin']) && isset($_POST['passwordAdmin']) && isset($_POST['mailAdmin'])) { 

		if(isset($_SESSION['admin'])) {

			if($_POST['nameAdmin'] == NULL || $_POST['passwordAdmin'] == NULL || $_POST['mailAdmin'] == NULL) {

				echo 'empty';													// $_POST are empty 

			} else {

				$createAdmin = $pageAdmin->storeAdmin(htmlspecialchars($_POST['nameAdmin']), htmlspecialchars($_POST['passwordAdmin']), htmlspecialchars($_POST['mailAdmin']));

				if($createAdmin == true) { 										// return id of new admin stored	

					echo $createAdmin;

				}
				else if($createAdmin == false) { 								// admin is not valid anymore 

					echo 'error';
				}
				else if($createAdmin == 'invalidName') {						// name is invalid 

					echo 'invalidName';
				}
				else if($createAdmin == 'notEnough') {							// invalid password criteria 

					echo 'notEnough';
				}
				else if($createAdmin == 'notUpper') {

					echo 'notUpper';
				}
				else if($createAdmin == 'notUpper') {

					echo 'noNumber';
				}
				else if($createAdmin == 'notUpper') {

					echo 'noSpecial';
				}
				else if($createAdmin == 'invalidMail') {						// mail is invalid 

					echo 'invalidMail';
				}
				else { 															// return data if input value already 																	exists in bdd
					echo $createAdmin;
				}	
			}
		}
		else { 																		// user is not connected as admin

			echo 'failed';
		}
	}
	else {

		throw new \Exception('index inexistants');
	}
				
}


// show "update" pages  

else if($_GET['adminaction'] == 'updateadmin' || $_GET['adminaction'] == 'updatepasspage'){

	if(isset($_SESSION['admin'])) {	

		if(isset($_GET['id'])) { 

			if(is_numeric($_GET['id'])) {

				$pageAdmin->updateAdmin($_GET['id'], $_GET['adminaction']);
			}
				
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new Exception('Il vous manque l\'id pour accéder à la page !');
		}
	}
	else { 

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}		
}


// update admin 

else if($_GET['adminaction'] == 'storeupdate'){

	if(isset($_GET['id']) && isset($_POST['updateName']) && isset($_POST['updateMail'])) {

		if(isset($_SESSION['admin'])) {

			if(is_numeric($_GET['id'])) {

				if($_POST['updateName'] == NULL || $_POST['updateMail'] == NULL) {

					echo 'empty';												// $_POST are NULL 
				}
				else {

					$updateAdmin = $pageAdmin->storeUpdate($_GET['id'], htmlspecialchars($_POST['updateName']), htmlspecialchars($_POST['updateMail']));

					if($updateAdmin == 'true') {	

						echo 'success';											// admin is updated 
					}
					else if($updateAdmin == 'error') {							// admin is not valid anymore 

						echo 'error';
					}
					else if($updateAdmin == 'similarName') {					// name is already used 

						echo 'similarName';
					}
					else if($updateAdmin == 'similarUpdateMail') {				// mail is already used 

						echo 'similarUpdateMail';
					}
					else if($updateAdmin == 'invalidName') {					// name is invalid 

						echo 'invalidName';
					}
					else if($updateAdmin == 'invalidUpdateMail') {				// mail is invalid 

						echo 'invalidUpdateMail';
					}
					
				}

			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {																		// user is not connected as admin

			echo 'failed';
		}
	}	
	else {

		throw new \Exception('index inexistants');
	}
			
}


// update admin password

else if($_GET['adminaction'] == 'updatepassword') {

	if(isset($_GET['id']) && isset($_GET['nom']) && isset($_POST['formerPassword']) && isset($_POST['newPassword'])) {

		if(isset($_SESSION['admin'])) {

			if(is_numeric($_GET['id']) && is_string($_GET['nom']))  {

				if($_POST['formerPassword'] == NULL || $_POST['newPassword'] == NULL) {

					echo 'empty';												// $_POST are empty 
				}
				else {

					$updatePassword = $pageAdmin->updatePassword($_GET['id'], $_GET['nom'], $_POST['formerPassword'], $_POST['newPassword']);

					if($updatePassword == 'success') {							// password is updated 

						echo $updatePassword;
					}

					else if($updatePassword == 'failed'){						// former password is wrong 

						echo $updatePassword;
					}

					else if($updatePassword == 'similarPassword'){

						echo 'similarPassword';									// new password already exists 
					}

					else if($updatePassword == 'notEnough'){

						echo 'notEnough';									// Regex 
					}
					else if($updatePassword == 'notUpper') {

						echo 'notUpper';
					}
					else if($updatePassword == 'noNumber') {

						echo 'noNumber';
					}
					else if($updatePassword == 'noSpecial') {

						echo 'noSpecial';
					}
				}
			}
			else {

				throw new \Exception('id et nom incorrects');
			}
		}
		else {																		// if user is not connected as admin

			echo 'error';
		}
	}
	else {

		throw new \Exception('index inexistants');
	}
		
}


// delete single admin 

else if($_GET['adminaction'] == 'deleteadmin'){

	if(isset($_SESSION['admin'])) { 

		if(isset($_GET['id'])) {

			if(is_numeric($_GET['id'])) {

				$deleteAdmin = $pageAdmin->deleteAdmin($_GET['id']);

				header('Location: /projet_4/index.php?adminaction=createadmin');			// if we send the url with keybord
			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}
	}
	else {																		// if user is not connected as admin

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}		
}