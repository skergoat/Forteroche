<?php 

namespace Controller;


use Model\Picture\PictureManager;


require_once('Model/Picture/PictureManager.php');


class PictureController 
{

	// update picture

	public function updatePicture($fichier, $id) {

		$url = 'public/uploads/' . basename($fichier['name']);				// create data 
        $alt = $fichier['name']; 
        																	// verifier que url pas presente 
        $update = new PictureManager;

        // $verify = $update->verifyPicture($alt);

        // echo $verify;

   //      if($verify) {

        	$update->updateImage($url, $alt);									// update data 						
			    $maxID = $update->getMax();
			    $update->updatePostPicture($id, $maxID[0]);							// update post table 

	        move_uploaded_file($fichier['tmp_name'], $url);						// move file 

	        header('Location: index.php?postaction=update&id=' . $id);	

   //      }
   //      else {

   //      	throw new \Exception('L\'image existe deja');
   //      }

	}

}