<?php

namespace Controller;

use Controller\PostsController;
use Model\Auth\AdminManager;
use Model\Replies\RepliesManager;
use Services\NotificationMail;

require_once('Model/Replies/RepliesManager.php');
require_once('Model/Comment/CommentManager.php');
require_once('Model/Auth/AdminManager.php');
require_once('Services/notificationMail.php');


class RepliesController {

	/**
	*	Create new Reply
	**/	
	public function storeReply($id, $postid, $message) {

		$AdminCreate = new AdminManager;
		$adminStillExists = $AdminCreate->existAdmin($_SESSION['id']);

		if($adminStillExists) {

			$store = new RepliesManager;
			$mail = $store->createReply($id, $postid, $message);				// store reply 

			$store->updateReply(1, $id);								// indicate comment is replied 

			$max = $store->maxReplyId();


			$MailClass = new NotificationMail;

			$email = $mail['mail'];

			$messageTxt = "Vous venez de recevoir une reponse de Jean Forteroche";
			$messageHtml = "<html><head></head><body><h2>Vous venez de recevoir une reponse de Jean Forteroche : </h2><br/><p><strong>" . $message . "</strong></p><br/><a href='https://www.skergoat.com/projet_4/index.php'>voir</a></body></html>";

			$sendMail = $MailClass->sendNotification($email, $messageTxt, $messageHtml);


			return $max[0];

		}
		else {

			return 'error';
		}
	}

	/**
	*	Get replies by comments on post page 
	**/
	public function getRepliesByComment($commentid) {

		$getReplies = new RepliesManager;
		$replies = $getReplies->getReplyByComment($commentid);

		return $replies;
	}

	/**
	*	Count number of replies on page 
	**/
	public function countReplies($id) {

		$count = new RepliesManager;
		$countReplies = $count->countRepliesByPost($id);

		return $countReplies;
	}

	/**
	*	Delete 
	**/
	public function deleteReply($id) {

		$deleteReplies = new RepliesManager;

		$existReply = $deleteReplies->replyExists($id);

		if($existReply) {														// if rteply exists 

			$getId = $deleteReplies->getReply($id);								// get comment id 
			$commentid = $getId['comment_id'];

			$verifyCommentId = $deleteReplies->countComment($commentid);		// if comment has no replies 

			if($verifyCommentId[0] == 1) {

				$deleteReplies->updateReply(0, $commentid);						// change replied value in comment table 
			}

			$deleteReplies->destroyReply($id);
			header('Location: index.php?postaction=post&id=' . $_GET['postid']); // delete reply 

		}
		else {

			throw new \Exception('la reponse n\'existe pas');
		}
	}

}

