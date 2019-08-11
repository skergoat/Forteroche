<?php 

/**
*	Themas 
**/


// create thema 

if($_GET['themeaction'] == 'createthema'){

	if(isset($_POST['thema']) && isset($_POST['id'])) {

		if(isset($_SESSION['admin'])) {

			if($_POST['thema'] == NULL) {

				echo 'empty';
			}
			else {

				$redirect = $thema->storeThema(htmlspecialchars($_POST['thema']));

				if($redirect) {

					echo $redirect;

				}
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


// Create theme post 

else if($_GET['themeaction'] == 'themepost'){

	if(isset($_GET['id']) && isset($_POST['theme'])) {

		if(isset($_SESSION['admin'])) {

			if(is_numeric($_GET['id'])) {

				$themePost = $thema->postTheme($_GET['id'], $_POST['theme']);

				if($themePost) {

					echo 'postThema';
				}

			}
			else {

				throw new \Exception('L\'id doit être un nombre');
			}
		}
		else {

			echo 'failed';
		}
	}
	else {

		header('Location: /projet_4/index.php?postaction=update&id=' . $_GET['id']);
	}
} 


//  thema 

else if($_GET['themeaction'] == 'deletethema'){

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id']) && isset($_GET['id_post'])) {

			if(is_numeric($_GET['id']) && is_numeric($_GET['id_post'])) {

				$deleteReturn = $thema->deleteThema($_GET['id']);

				if($deleteReturn) {

					header('Location: /projet_4/index.php?postaction=update&id=' . $_GET['id_post']);
				}

			}
			else {

				throw new \Exception('L\'id doit être un nombre');
			}

		}
		else {

			throw new \Exception('L\'article n\'existe pas');
		}
	}
	else {

		throw new \Exception('Vous n\'êtes pas connecté comme admin !');
	}

}
