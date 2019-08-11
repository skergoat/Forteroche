<?php 

namespace Controller;

require_once('Model/Comment/CommentManager.php');
require_once('Model/Replies/RepliesManager.php');
require_once('Services/notificationMail.php');

use Model\Auth\AdminManager;
use Model\Comment\CommentManager;
use Model\Post\PostsManager;
use Model\Replies\RepliesManager;
use Services\NotificationMail;

class CommentController 
{	

	/**
	* Show alert on "comments" buttons when there are comments 
	**/
	public function alert() {

		$getNumberComments = new CommentManager;

		$new = $getNumberComments->countNewComments();
		$reported = $getNumberComments->countReportedComments();

		$addition = $new + $reported;

		return $addition;

	}

	/**
	* show comments
	**/
	public function showComment($id) {

		$comments = new CommentManager;
		$ListComments = $comments->show($id);

		return $ListComments;
	}

	/**
	* store comments
	**/
	public function storeComment($id, $author, $mail, $content){		// send notification mail to admin  

		if(preg_match('#[a-z0-9._-]{1,20}@[a-z0-9._-]{1,20}\.[a-z]{1,3}#isU', $mail)) {

			$storeComment = new CommentManager;
			$commentStored = $storeComment->store($id, $author, $mail, $content);

			foreach($commentStored as $stored) {

				$MailClass = new NotificationMail;

				$email = $stored->getEmail();

				$messageTxt = "Vous venez de recevoir un nouveau commentaire : voir";
				$messageHtml = "<html><head></head><body><h2>Vous venez de recevoir un nouveau commentaire :</h2><h3>Par " . $author . " / email : " . $mail . "</h3><p>" . $content . "</p><a href='https://www.skergoat.com/projet_4/index.php'>voir</a></body></html>";

				$sendMail = $MailClass->sendNotification($email, $messageTxt, $messageHtml);

			}

			return true; 
		}
		else {

			return false;
		}
	}


	/**
	* show "moderate" or "reported" page
	**/
	public function moderate($action) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if admin who creates post still exists in bdd


		if($adminStillExists) {

			$moderateComments = new CommentManager;	
																// show "moderate" or "reported" page
																// depends on the "ridden" or "reported"
																// value in bdd 

			$nbNewComments = $moderateComments->countNewComments();
			$nbReportedComments = $moderateComments->countReportedComments();


			if($action == "moderate") {	

				$messageTotal = 4;									// paginate 

				$total = $moderateComments->countTotalComments(0, 0);

				$total = $total[0];

				$nbdePages = ceil($total / $messageTotal);

				if(isset($_GET['paginate'])){

					$pageActuelle = intval($_GET['paginate']);

					if($pageActuelle > $nbdePages){

						$pageActuelle = $nbdePages;
					}

				} else {

					$pageActuelle = 1;
				}

				$premiereEntree = ($pageActuelle - 1) * $messageTotal;

				if($premiereEntree < 0) {

					$premiereEntree = 0;
				}

				$showNewComments = $moderateComments->moderatePaginate(0, 0, $premiereEntree, $messageTotal);
				require('view/Back/Comments/moderate.php');
			}

			else if($action == "reported") {

				$messageTotal = 4;									// paginate 

				$total = $moderateComments->countTotalComments(1, 1);

				$total = $total[0];

				$nbdePages = ceil($total / $messageTotal);

				if(isset($_GET['paginate'])){

					$pageActuelle = intval($_GET['paginate']);

					if($pageActuelle > $nbdePages){

						$pageActuelle = $nbdePages;
					}

				} else {

					$pageActuelle = 1;
				}

				$premiereEntree = ($pageActuelle - 1) * $messageTotal;

				if($premiereEntree < 0) {

					$premiereEntree = 0;
				}					

				$showNewComments = $moderateComments->moderatePaginate(1, 1, $premiereEntree, $messageTotal);
				require('view/Back/Comments/reported.php');
			}
		}
		else {

			$admin = new AdminController;
			$admin->logout();
		}

	}

	/**
	* report or validate comment
	**/
	public function validateOrReport($id, $validated, $reported, $action, $page, $postid) { 

		$setComment = new CommentManager;
		$verifyComment = $setComment->existComment($id);

		if($verifyComment) {							// if comment exists 
														// set "ridden" or "reported" value in bdd
			if($action == 'validate') {

				$validateAdmin = new AdminManager;  
				$adminStillExists = $validateAdmin->existAdmin($_SESSION['id']);

				if($adminStillExists) {					// if user is still registered as admin at the time he tries to 										validate comment
					
					$setComment->setCommentValue($id, $validated, $reported);

					if($page == "moderate") {			// show "reported" or "moderate" page

						return true;
					}
					else if($page == "reported") {

						return true;
					}
				}
				else {

					return false;
				}

			}
														// or if user is not an admin
														// just report comment 
			else if($action == 'report') {	

				$MailClass = new NotificationMail;

				$mail = $setComment->getMailComment($id);
				$email = $mail['mail'];

				$messageTxt = "Votre commentaire a été signalé";
				$messageHtml = "<html><head></head><body><p><strong>Votre commentaire :</strong> " . $mail['content'] . "<strong> a été signalé</strong></p><br/><a href='https://www.skergoat.com/projet_4/index.php'>voir</a></body></html>";

				$sendMail = $MailClass->sendNotification($email, $messageTxt, $messageHtml);


				$setComment->setCommentValue($id, $validated, $reported);
			
				return true;
			}

		}
		else {

			throw new \Exception('Le commentaire n\'existe pas');
		} 	
		
	} 

	/**
	*	Show Reply page 
	**/
	public function Reply() {

		$AdminCreate = new AdminManager;
		$adminStillExists = $AdminCreate->existAdmin($_SESSION['id']);

		if($adminStillExists){

			$comment = new CommentManager;
			$commentResponse = $comment->countComments();			// count if there are comments

																	// paginate 
			$total = $commentResponse;

			$messageTotal = 20;

			$nbdePages = ceil($total / $messageTotal);

			if(isset($_GET['paginate'])){

				$pageActuelle = intval($_GET['paginate']);

				if($pageActuelle > $nbdePages){

					$pageActuelle = $nbdePages;
				}

			} else {

				$pageActuelle = 1;
			}

			$premiereEntree = ($pageActuelle - 1) * $messageTotal;

			$commentList = $comment->showAllComments($premiereEntree, $messageTotal); 			// show table comments 

			Require('view/Back/Comments/Reply.php');

		}
		else {

			throw new \Exception('Vous n\'êtes pas connecté comme admin');
		}
	}

	/**
	* delete single comment
	**/
	public function deleteComment($id, $page) {

		$Admin = new AdminManager;
		$adminStillExists = $Admin->existAdmin($_SESSION['id']); // if who create post still exists in bdd

		if($adminStillExists) {

			$moderateComments = new CommentManager;
			$verifyComment = $moderateComments->existComment($id, null);

			if($verifyComment) {

				$reply = new RepliesManager;					// delete associated replies 
				$reply->deleteReplyByComment($id);


				$MailClass = new NotificationMail;

				$mail = $moderateComments->getMailComment($id);
				$email = $mail['mail'];

				$messageTxt = "Votre reponse a ete supprimee";
				$messageHtml = "<html><head></head><body><p><strong>Votre commentaire :</strong> " . $mail['content'] . "<strong> a été supprimé</strong></p><br/><a href='https://www.skergoat.com/projet_4/index.php'>voir</a></body></html>";

				$sendMail = $MailClass->sendNotification($email, $messageTxt, $messageHtml);


				$moderateComments->deleteReadComment($id);
			}
			else {

				throw new \Exception('Le commentaire n\'existe pas');
			}
		}
		else {												// if admin is not connected when he tries to delete comment
															// he is logged out 
			$admin = new AdminController;						
			$admin->logout();
		}

	} 

}