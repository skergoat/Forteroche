<?php

/**
* Moderate Comments  
**/

if($_GET['comaction'] == 'moderate'){

	if(isset($_GET['action'])) {


		// show "moderate" or "reported" page 

		if($_GET['action'] == 'moderate') {

			if(isset($_SESSION['admin'])) {

				$newComment->moderate($_GET['action']);
			}
			else {

				throw new \Exception('Vous n\'êtes pas connecté comme admin !');
			}
		}
		else if($_GET['action'] == 'reported') {

			if(isset($_SESSION['admin'])) {

				$newComment->moderate($_GET['action']);
			}
			else {

				throw new \Exception('Vous n\'êtes pas connecté comme admin !');
			}
		}


		// report or validate one comment 

		else if($_GET['action'] == 'validate') {

			if(isset($_SESSION['admin'])) {

				if(isset($_GET['id']) && isset($_GET['page'])) {

					if(is_numeric($_GET['id']) && is_string($_GET['page']) && is_string($_GET['action'])) {

						$validate = $newComment->validateOrReport($_GET['id'], 1, 0, $_GET['action'], $_GET['page'], null);

						if($_GET['page'] == 'moderate') {

							header('Location: /projet_4/index.php?comaction=moderate&action=moderate');
						}
						else if($_GET['page'] == 'reported') {

							header('Location: /projet_4/index.php?comaction=moderate&action=reported');

						}
						
					}
					else {

						throw new \ErrorException('L\'id doit être un nombre, la page et l\'action des strings');
					}
				}
				else {

					throw new \ErrorException('Il manque un id et/ou une page');
				}
			}
			else {											// admin is not connected when tries to validate comment
				
				header('Location: /projet_4/index.php?adminaction=admin');
			}
			
		}

		else if($_GET['action'] == 'report') {

			if(isset($_GET['id']) && isset($_GET['postid'])) {

				if(is_numeric($_GET['id']) && is_numeric($_GET['postid']) && is_string($_GET['action'])) {

					$report = $newComment->validateOrReport($_GET['id'], 1, 1, $_GET['action'], null, $_GET['postid']);

					echo 'page non trouvée';

				}
				else {

					throw new \ErrorException('L\'id et le postid doivent être des nombres et l\'action un string');
				}
			}
			else {

				throw new \ErrorException('Il manque un id et/ou un postid');
			}
						
		}

	}
	else {

		throw new \Exception('Il manque un parametre "action"');
	}

}

/**
* Show Reply page 
**/

else if($_GET['comaction'] == 'reply'){

	if(isset($_SESSION['admin'])) {

		$newComment->Reply();

	}	
	else {													// admin is not connected when tries to delete comment 

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}
}


// else if($_GET['comaction'] == 'getcommentbypost'){

// 	if(isset($_SESSION['admin'])) {

// 		if(isset($_GET['id'])) {

// 			if(is_numeric($_GET['id'])) {

// 				// $newComment->getCommentByPost($_GET['id']);

// 			}
// 			else {

// 				throw new \ErrorException('L\'id doit être un nombre et la page un string');
// 			}
// 		}
// 		else {

// 			throw new \Exception('Il vous manque un id pour accéder a la page');
// 		}

// 	}	
// 	else {													// admin is not connected when tries to delete comment 

// 		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
// 	}
// }



// delete single comment 

else if($_GET['comaction'] == 'delete'){

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id'])) {

			if(is_numeric($_GET['id']) && is_string($_GET['page'])) {

				$delete = $newComment->deleteComment($_GET['id'], $_GET['page']);

				if($_GET['page'] == 'reported' || $_GET['page'] == 'moderate') {

					header('Location: /projet_4/index.php?comaction=moderate&action=' . $_GET['page']);
				}
				else if($_GET['page'] == 'post') {

					header('Location: /projet_4/index.php?postaction=post&id=' . $_GET['postid']);
				}
				else if($_GET['page'] == 'reply') {

					header('Location: /projet_4/index.php?comaction=getcommentbypost&id=' .  $_GET['postid']); 
				}	

			}
			else {

				throw new \ErrorException('L\'id doit être un nombre et la page un string');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}
	
	}	
	else {													// admin is not connected when tries to delete comment 

		header('Location: /projet_4/index.php?adminaction=admin');
	}

}
