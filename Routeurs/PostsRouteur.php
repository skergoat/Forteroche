<?php

/**
* Posts
**/


if($_GET['postaction'] == 'search'){

	if(isset($_GET['keyword'])) {

		// if($_GET['keyword'] == NULL) {

		// 	throw new \Exception('remplissez le champ svp');
		// }
		// else {

			$listePosts->search($_GET['keyword']);
		// }
	}
	else {

		header('Location: /projet_4/index.php');
	}
}


/**
*	Show index on page 
**/
else if($_GET['postaction'] == 'getindex'){

	if(isset($_GET['id']) || isset($_GET['id']) && isset($_GET['id_post'])) {

		if(is_numeric($_GET['id'])) {

			if(isset($_GET['id_post'])) {

				if(is_numeric($_GET['id_post'])) {

					$test = $listePosts->getIndex($_GET['id'], $_GET['id_post']);

				}
				else {

					throw new \ErrorException('L\'id doit être un nombre');
				}
			}
			else {

				$listePosts->getIndex($_GET['id'], null);

			}

		}
		else {

			throw new \ErrorException('L\'id doit être un nombre');
		}

	}
	else {

		throw new \Exception('Il vous manque un id pour accéder a la page');
	}

}


// show single post

else if($_GET['postaction'] == 'post'){


	if(isset($_GET['id'])) {

		if(is_numeric($_GET['id'])) {

			$listePosts->post($_GET['id']);	
		}
		else {

			throw new \ErrorException('L\'id doit être un nombre');
		}
	}
	else {

		throw new \Exception('Il vous manque un id pour accéder a la page');
	}
	
}

else if($_GET['postaction'] == 'managearticles'){ 

	if(isset($_SESSION['admin'])) {

		$listePosts->managePost();

	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}
}

// show "create" page 

else if($_GET['postaction'] == 'create'){

	if(isset($_SESSION['admin'])) {

		$listePosts->create();	
	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}
}

// show "update" page 

else if($_GET['postaction'] == 'update'){

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id'])) {

			if(is_numeric($_GET['id'])) {

				$listePosts->update($_GET['id']);
			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}
	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}
}

// update single post 

else if($_GET['postaction'] == 'updatepost'){

	if(isset($_GET['id']) && isset($_POST['title']) && isset($_POST['content'])) {

		if(isset($_SESSION['admin'])) {

			if(is_numeric($_GET['id'])) {

				$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img><htm><body><!doctype html><center><small>';
				$allowedTags.='<li><ol><ul><span><div><br><ins><del><dl><dd>';  

				$update = $listePosts->updatePost($_GET['id'], htmlspecialchars($_POST['title']), strip_tags(stripslashes($_POST['content']), $allowedTags)); 

				if($update) {

					echo "success"; 						// post is update 
				}
				else {

					echo 'error';							// current admin is not valid anymore 
				}
				
			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		
		}
		else {

			echo 'failed';	
																// admin is not connected when tries to update post 
		}
	}
	else {

		throw new \Exception('index inexistants');
	}
}

/**
* Publish or not a post 
**/
else if($_GET['postaction'] == 'published') {

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id']) && isset($_GET['action'])) {

			if(is_numeric($_GET['id']) && is_string($_GET['action'])) {

				$listePosts->publish($_GET['id'], $_GET['action']);
			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}

	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}

}

// delete single post 

else if($_GET['postaction'] == 'destroy'){

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id'])) {

			if(is_numeric($_GET['id'])) {

				$listePosts->destroy($_GET['id']);
				header('Location: /projet_4/index.php?postaction=managearticles');
			}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}
	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}

}

/**
* picture
**/

if($_GET['postaction'] == 'updatepicture') {

	if(isset($_FILES['monfichier'])) {

		if(isset($_SESSION['admin'])) {

			if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
			{
		        if ($_FILES['monfichier']['size'] <= 8000000)
		        {
		        	if(preg_match('#^([a-zA-Z0-9_-])+\.([a-zA-Z]){3}$#', $_FILES['monfichier']['name'])) 
		        	{

				        $infosfichier = pathinfo($_FILES['monfichier']['name']);
				        $extension_upload = $infosfichier['extension'];
				        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG');

				        if (in_array($extension_upload, $extensions_autorisees))
				        {
				            $picture = $listePosts->updatePicture($_FILES['monfichier'], $_GET['id']); 

				            if($picture == 'error') {

				            	echo 'error';
				            }
				            else {

				            	echo $picture;
				            } 
				            
				        }
				        else {

				        	echo 'non-autorized';
				        }
				    }
				    else {

				    	echo 'invalid-name';
				    }    
		        }
		        else {

					echo 'non-autorized';
				}
			}
			else {

				echo 'empty';
			}
		}
		else {

			echo 'error';
		}
	}
	else {

		throw new \Exception('index inexistants');
	}

}

/**
* Delete picture
**/

if($_GET['postaction'] == 'deletepicture') {

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id'])) {

			if(is_numeric($_GET['id'])) {

        		$deletePicture = $listePosts->deletePicture($_GET['id']);

        		header('Location: /projet_4/index.php?postaction=update&id=' . $_GET['id']);
        		
        	}
			else {

				throw new \ErrorException('L\'id doit être un nombre');
			}
		}
		else {

			throw new \Exception('Il vous manque un id pour accéder a la page');
		}        
	}
	else {

		throw new \Exception('vous n\'êtes pas connecté comme admin');
	}
}


/**
* Comments 
**/

// create new comment on single post page 

if($_GET['postaction'] == 'postcomment'){

	if(isset($_GET['id']) && isset($_POST['author'])  && isset($_POST['mail']) && isset($_POST['contentComment'])) {

		if(is_numeric($_GET['id'])) {

			if($_POST['author'] == NULL || $_POST['contentComment'] == NULL || $_POST['mail'] == NULL) {

				echo 'empty';

			}
			else {

				if(strlen($_POST['contentComment']) < 1000) {
 
					$postComment = $newComment->storeComment($_GET['id'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['contentComment']));					

					if($postComment) {

						echo 'success';								// post is deleted 

					}else {

						echo 'invalidMail';
					}

				}
				else {

					echo 'tooLong';
				}

			}

		}
		else {

			throw new \ErrorException('L\'id doit être un nombre');
		}
	}
	else {

		throw new \Exception('index inexistants');
	} 
}



		