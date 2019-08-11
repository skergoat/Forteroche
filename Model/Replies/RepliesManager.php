<?php 

namespace Model\Replies;


use Model\Manager;
use Model\Replies\Replies;


require_once('Model/Manager.php');
require_once('Model/Replies/Replies.php');


class RepliesManager {


	protected $manager;

	public function __construct() {

		$this->manager = new Manager;
	}

	/**
	*	Create new Reply
	**/
	public function createReply($id, $postid, $message) {

		$manager = $this->manager->getManager(); 

		$store = $manager->prepare('INSERT INTO replies(comment_id, post_id, reply, created_at) VALUES(?, ?, ?, NOW())') or die(print_r($manager->errorMessage()));

		$store->execute(array($id, $postid, $message));


		$send = $manager->prepare('SELECT mail FROM comments WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$send->execute(array($id));

		$sendMail = $send->fetch();

		return $sendMail;

	}

	/**
	*	Indicate comment is replied in comments 
	**/
	public function updateReply($values, $id) {

		$manager = $this->manager->getManager(); 

		$updatePost = $manager->prepare('UPDATE comments SET replied = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$updatePost->execute(array($values, $id));

	}

	/**
	*	Show replies on post page 
	**/
	public function getReplyByComment($commentid){

		$replies = [];

		$manager = $this->manager->getManager(); 

		$listReplies = $manager->prepare('SELECT * FROM replies WHERE comment_id = ? ORDER BY ID ASC') or die(print_r($manager->errorMessage()));

		$listReplies->execute(array($commentid));

		while($reply = $listReplies->fetch()){

			$replies[] = new Replies($reply);
		}

		return $replies;
	}

	/**
	* Search if reply exists 
	**/
	public function replyExists($id) {

		$manager = $this->manager->getManager(); 

		return (bool) $manager->query('SELECT COUNT(*) FROM replies WHERE ID = ' . $id)->fetchColumn();

	}

	/**
	*	Return max reply id for JS 
	**/
	public function maxReplyId() {

		$manager = $this->manager->getManager();

		$reply = $manager->query('SELECT MAX(ID) FROM replies') or die(print_r($manager->errorMessage())); 

		$maxReply = $reply->fetch(); 

		return $maxReply;

	}

	/**
	*	Count if there are replies under each post
	**/
	public function countRepliesByPost($id)
    {
    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM replies WHERE comment_id =' . $id)->fetchColumn();
    }


	/**
	*	Delete Replies when delete comment 
	**/
	public function deleteReplyByPost($id) {

		$manager = $this->manager->getManager(); 

		$manager->query('DELETE FROM replies WHERE post_id = ' . $id); 
	}

	/**
	*	Delete Replies when delete comment 
	**/
	public function deleteReplyByComment($id) {

		$manager = $this->manager->getManager(); 

		$manager->query('DELETE FROM replies WHERE comment_id = ' . $id); 
	}

	/**
	* Count if there are replies for one comment
	**/
	public function countComment($commentid) {

		$manager = $this->manager->getManager(); 	// if keyword exists 

		$verif = $manager->prepare('SELECT COUNT(*) FROM replies WHERE comment_id = ?');

		$verif->execute(array($commentid));

		$reply = $verif->fetchColumn();

		return $reply;
	}

	/**
	*	Get Reply by id
	**/
	public function getReply($id) {

		$manager = $this->manager->getManager(); 

		$reply = $manager->query('SELECT * FROM replies WHERE ID = ' . $id);

		$returnReply = $reply->fetch();

		return $returnReply; 
	}

	/**
	*	Delete reply
	**/
	public function destroyReply($id) {

		$manager = $this->manager->getManager(); 

		$manager->query('DELETE FROM replies WHERE ID = ' . $id);

	}



} 