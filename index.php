<?php

session_start();

require('Controller/PostsController.php');
require('Controller/AdminController.php');
require('Controller/ThemaController.php');
require('Controller/RepliesController.php');

use Controller\AdminController;
use Controller\PostsController;
use Controller\CommentController;
use Controller\ThemaController; 
use Controller\RepliesController; 

$listePosts = new PostsController;
$pageAdmin = new AdminController;
$newComment = new CommentController;
$thema = new ThemaController;
$replies = new RepliesController;


$url = $_SERVER['REQUEST_URI'];


require('Routes.php'); 


try {

	if($reponse == true) {

	    if(isset($_GET['postaction'])) {

			require('Routeurs/PostsRouteur.php');
		}

		else if(isset($_GET['adminaction'])) {

			require('Routeurs/AdminRouteur.php');
		}

		else if(isset($_GET['comaction'])) {

			require('Routeurs/CommentRouteur.php');
		}

		else if(isset($_GET['themeaction'])) {

			require('Routeurs/ThemaRouteur.php');
		}

		else if(isset($_GET['replyaction'])) {

			require('Routeurs/RepliesRouteur.php');
		}

		else if(isset($_GET['websiteaction'])) {

			require('Routeurs/WebsiteRouteur.php');
		}

		else {

			$listePosts->accueil();
		}
	}
	else {

		throw new \Exception('Erreur 404');
	}
		    
}
catch(\Exception $e){

	$errorMessage = $e->getMessage();
	require('view/exceptionView.php');
}
catch (\RuntimeException $e)
{
  $errorMessage = $e->getMessage();
  require('view/exceptionView.php');
}

