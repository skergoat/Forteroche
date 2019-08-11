<?php 

namespace Model\Comment;

use Model\Manager;
use Model\Comment\Comment;
use Model\Auth\Admin;

require_once('Model/Manager.php');
require_once('Comment.php');
require_once('Model/Auth/Admin.php');

class CommentManager
{
	protected $manager;

	public function __construct()
	{
		$this->manager = new Manager;
	}

	/**
	* show comments list  
	**/
	public function show($id){

		$comments = [];

		$manager = $this->manager->getManager(); 

		$listComments = $manager->prepare('SELECT * FROM comments WHERE post_id = ? AND ridden = 1 AND reported = 0 ORDER BY id DESC') or die(print_r($manager->errorMessage()));

		$listComments->execute(array($id));

		while($comment = $listComments->fetch()){

			$comments[] = new Comment($comment);
		}

		return $comments;
	}


	/**
	* Show and Paginate comments 
	**/
	public function showAllComments($premiereEntree, $messageTotal){

		$comments = [];

		$manager = $this->manager->getManager(); 

		$listComments = $manager->query('SELECT ID, post_id, author, mail, DATE_FORMAT(date_comment, "%d/%m/%Y") as date_comment, reported, ridden, replied FROM comments ORDER BY id DESC LIMIT ' . $premiereEntree . ', ' . $messageTotal) or die(print_r($manager->errorMessage()));

		while($comment = $listComments->fetch()){

			$comments[] = new Comment($comment);
		}

		return $comments;
	}

	/**
	* show comments list on Reply page   
	**/
	public function showAllByComment($id, $premiereEntree, $messageTotal){

		$comments = [];

		$manager = $this->manager->getManager(); 

		$listComments = $manager->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC LIMIT ' . $premiereEntree . ', ' . $messageTotal) or die(print_r($manager->errorMessage()));

		$listComments->execute(array($id));

		while($comment = $listComments->fetch()){

			$comments[] = new Comment($comment);
		}

		return $comments;
	}

	/**
	* store new comment  
	**/
	public function store($post_id, $author, $mail, $content){

		$manager = $this->manager->getManager();

		$store = $manager->prepare('INSERT INTO comments(post_id, author, mail, content, date_comment, reported, ridden) VALUES(?, ?, ?, ?, NOW(), 0, 0)') or die(print_r($manager->errorMessage()));

		$store->execute(array($post_id, $author, $mail, $content));


		$mailAdmin = [];

		$admin = $manager->query('SELECT email FROM admin') or die(print_r($manager->errorMessage()));

		while($adminMail = $admin->fetch()){

			$mailAdmin[] = new Admin($adminMail);
		}

		return $mailAdmin ;
	}

	/**
	* Get Email to send delete notification 
	**/
	public function getMailComment($id) {

		$manager = $this->manager->getManager();

		$mail = $manager->prepare('SELECT * FROM comments WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$mail->execute(array($id));

		$email = $mail->fetch();

		return $email;
	}

	/**
	* count comments 
	**/
	public function countComments()
    {
    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM comments')->fetchColumn();
    }

	/**
	* count if there are new comments 
	**/
	public function countNewComments()
    {
    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM comments WHERE ridden = 0')->fetchColumn();
    }

    /**
	* count if there are reported comments 
	**/
	public function countReportedComments()
    {
    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM comments WHERE reported = 1')->fetchColumn();
    }

    /**
	* count comments by post id 
	**/
	public function countCommentByPost($id)
    {
    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM comments WHERE post_id =' . $id)->fetchColumn();
    }

    /**
    *	Count if there are replies in bdd 
    **/
    public function countCommentByPostAndModerate($id) {

    	$manager = $this->manager->getManager();

    	return $manager->query('SELECT COUNT(*) FROM comments WHERE ridden = 1 AND reported = 0 AND post_id = ' . $id)->fetch();

    }

	/**
	* show list new comments  
	**/
	public function moderatePaginate($validated, $reported, $premiereEntree, $messageTotal) {

		$newComments = [];

		$manager = $this->manager->getManager();

		$moderateComments = $manager->prepare('SELECT * FROM comments WHERE ridden = ? AND reported = ? ORDER BY id DESC LIMIT ' . $premiereEntree . ', ' . $messageTotal) or die(print_r($manager->errorMessage()));

		$moderateComments->execute(array($validated, $reported));

		while($newComment = $moderateComments->fetch()){

			$newComments [] = new Comment($newComment);
		}

		return $newComments ;

	}

	/**
	* Count total comments 
	**/
	public function countTotalComments($validated, $reported) {

		$manager = $this->manager->getManager(); 

		$pagination = $manager->prepare('SELECT COUNT(*) FROM comments WHERE ridden = ? AND reported = ?') or die(print_r($bdd->errorMessage()));

		$pagination->execute(array($validated, $reported));

		$donnee = $pagination->fetch();
		
		return $donnee;
	}

	/** 
	* validate single comment 
	**/
	public function setCommentValue($id, $validated, $reported){

		$manager = $this->manager->getManager();

		$validateComment = $manager->prepare('UPDATE comments SET ridden = ?, reported = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$validateComment->execute(array($validated, $reported, $id));
	}

	/**
	* existence of id in bdd    
	**/
	public function existComment($id) {

		$manager = $this->manager->getManager();

	    $verify = $manager->prepare('SELECT COUNT(*) FROM comments WHERE ID = ?') or die(print_r($manager->errorMessage()));

	    $verify->execute(array($id));

	    $response = $verify->fetchColumn(); 

	    return (bool) $response;
	   
	}

	/**
	*	delete single comment 
	**/
	public function deleteReadComment($id) {

		$manager = $this->manager->getManager();

		$destroy = $manager->prepare('DELETE FROM comments WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$destroy->execute(array($id)); 
	}

	/**
	*	delete all deleted post comment 
	**/
	public function deletePostComment($id) {

		$manager = $this->manager->getManager();

		$destroy = $manager->prepare('DELETE FROM comments WHERE post_id = ?') or die(print_r($manager->errorMessage()));

		$destroy->execute(array($id)); 
	}

}