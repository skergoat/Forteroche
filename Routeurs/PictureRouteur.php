<?php 

/**
* Manage pictures 
**/


//	update picture

if($_GET['pictureaction'] == 'update') {

	if(isset($_SESSION['admin'])) {

		if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
		{
	        if ($_FILES['monfichier']['size'] <= 8000000)
	        {
		        $infosfichier = pathinfo($_FILES['monfichier']['name']);
		        $extension_upload = $infosfichier['extension'];
		        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

		        if (in_array($extension_upload, $extensions_autorisees))
		        {
		            $picture->updatePicture($_FILES['monfichier'], $_GET['id']);  
		        }
		        else {

		        	throw new \Exception('extension non autorisée');
		        }    
	        }
	        else {

				throw new \Exception('fichier trop volumineux');
			}
		}
		else {

			throw new \Exception('veuillez envoyer un fichier, svp');
		}
	}
	else {

		throw new \Exception('vous n\'êtes pas connecté comme admin');
	}
}


// delete picture

else if($_GET['pictureaction'] == 'delete') {

	echo 'hello';

}