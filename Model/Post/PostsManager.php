<?php

namespace Model\Post;

use Model\Manager;
use Model\Post\Posts;
use Model\Thema\Themas;

require_once('Model/Manager.php');
require_once('Posts.php');
require_once('Model/Thema/Themas.php');


class PostsManager 
{
	/**
	* Create new mysql connection  
	**/
	protected $manager;

	public function __construct()
	{
		$this->manager = new Manager;
	}

	/**
	* show posts list  
	**/
	public function show(){

		$posts = [];

		$manager = $this->manager->getManager(); 

		$listMessage = $manager->query('SELECT * FROM posts WHERE published = 1 ORDER BY id DESC LIMIT 0, 10') or die(print_r($manager->errorMessage()));

		while($messages = $listMessage->fetch()){

			$posts[] = new Posts($messages);
		}

		return $posts;
	}

	/**
	*	Paginate table post on admin page 
	**/
	public function postPaginate($premiereEntree, $messageTotal){

		$posts = [];

		$manager = $this->manager->getManager(); 

		$listMessage = $manager->query('SELECT * FROM posts WHERE published = 1 ORDER BY id DESC LIMIT ' . $premiereEntree . ', ' . $messageTotal) or die(print_r($manager->errorMessage()));

		while($messages = $listMessage->fetch()){

			$posts[] = new Posts($messages);
		}

		return $posts;
	}

	/**
	* Count toal posts 
	**/
	public function countTotalPosts() {

		$manager = $this->manager->getManager(); 

		$pagination = $manager->query('SELECT COUNT(*) FROM posts WHERE published = 1') or die(print_r($bdd->errorMessage()));

		$donnee = $pagination->fetch();
		
		return $donnee;
	}

	/**
	*	Search zone
	**/
	public function searchWord($keyword) {

		$manager = $this->manager->getManager(); 	// if keyword exists 

		$verif = $manager->prepare('SELECT COUNT(*) FROM posts WHERE title LIKE ?');

		$verif->execute(array("%".$keyword."%"));

		$reply = $verif->fetchColumn();

		$reply = (bool) $reply;


		if($reply == 1) {							// show articles in which we find keywords  

			$titles = [];

			$listTitle = $manager->prepare('SELECT * FROM posts WHERE title LIKE ?') or die(print_r($manager->errorMessage()));

			$listTitle->execute(array("%".$keyword."%"));

			while($title = $listTitle->fetch()){

				$titles[] = new Posts($title);
			}

			return $titles;

		}
		else {

			return false;

		}

	}

	/**
	*	Count if no post have thema = 0
	**/
	public function countThema() {

    	$manager = $this->manager->getManager();

    	$nbThema = $manager->query("SELECT COUNT(*) FROM posts WHERE theme_id = 0");

    	$nb1 = $nbThema->fetchColumn(); 


    	$nbColumn = $manager->query("SELECT COUNT(*) FROM posts");

    	$nb2 = $nbColumn->fetchColumn(); 

    	if ($nb1 == $nb2) {

    		return "2";
    	}
    	else {

    		if($nb1 == 0) {

    			return "3";
    		}
    		else {

    			return "1";
    		}
    	} 	
	}

	/** 
	*	Show titles by thema 
	**/
	public function showIndex($id) {

		$titles = [];

		$manager = $this->manager->getManager(); 

		$listTitle = $manager->prepare('SELECT * FROM posts WHERE theme_id = ? ORDER BY theme_id ASC') or die(print_r($manager->errorMessage()));

		$listTitle->execute(array($id));

		while($title = $listTitle->fetch()){

			$titles[] = new Posts($title);
		}

		return $titles;
	}


	/**
	*	Show titles before the one selected 
	**/
	public function moreThan($id) {

		$more = [];

		$manager = $this->manager->getManager(); 

		$listMore = $manager->prepare('SELECT * FROM Thema WHERE ID < ? ORDER BY ID ASC') or die(print_r($manager->errorMessage()));

		$listMore->execute(array($id));

		while($moreThema = $listMore->fetch()){

			$more[] = new Themas($moreThema);
		}

		return $more;

	}

	/**
	*	Show titles after the one selected 
	**/
	public function lessThan($id) {

		$less = [];

		$manager = $this->manager->getManager(); 

		$listLess = $manager->prepare('SELECT * FROM Thema WHERE ID > ? ORDER BY ID ASC') or die(print_r($manager->errorMessage()));

		$listLess->execute(array($id));

		while($lessThema = $listLess->fetch()){

			$less[] = new Themas($lessThema);
		}

		return $less;

	}

	/**
	* show all posts in admin in ASC order 
	**/
	public function showAll($order){

		$posts = [];

		$manager = $this->manager->getManager(); 

		$listMessage = $manager->query('SELECT * FROM posts ORDER BY id' . $order) or die(print_r($manager->errorMessage()));

		while($messages = $listMessage->fetch()){

			$posts[] = new Posts($messages);
		}

		return $posts;
	}

	/**
	*	Paginate for admin post page 
	**/
	public function managePaginate($premiereEntree, $messageTotal, $order){

		$posts = [];

		$manager = $this->manager->getManager(); 

		$listMessage = $manager->query('SELECT * FROM posts ORDER BY id ' . $order . ' LIMIT ' . $premiereEntree . ', ' . $messageTotal) or die(print_r($manager->errorMessage()));

		while($messages = $listMessage->fetch()){

			$posts[] = new Posts($messages);
		}

		return $posts;
	}

	/**
	* Show posts without themas
	**/	
	public function withoutThema() {

		$without = [];

		$manager = $this->manager->getManager(); 

		$withoutTh = $manager->query('SELECT * FROM posts WHERE theme_id = 0 AND published = 1 ORDER BY id ASC') or die(print_r($manager->errorMessage()));

		while($withoutThema = $withoutTh->fetch()){

			$without[] = new Posts($withoutThema);
		}

		return $without;

	}

	/**
	* show one single post   
	**/
	public function showPost($id) {

		$id = (int) $id;

		$manager = $this->manager->getManager();

		$messageRetour = $manager->prepare('SELECT * FROM posts WHERE ID = ?') or die(print_r($manager->errorMessage())); 

		$messageRetour->execute(array($id));

		$post = $messageRetour->fetch();

		return new Posts($post);
	}

	/**
	* existence of id in bdd    
	**/
	public function existPost($id) {

		$manager = $this->manager->getManager();

	    return (bool) $manager->query('SELECT COUNT(*) FROM posts WHERE ID = '. $id)->fetchColumn();
	   
	}

	/**
	* existence of id of pubished post in bdd    
	**/
	public function existPostPublished($id) {

		$manager = $this->manager->getManager();

	    return (bool) $manager->query('SELECT COUNT(*) FROM posts WHERE published = 1 AND ID = '. $id)->fetchColumn();
	   
	}

	/**
	* store new empty post  
	**/
	public function storePost(){

		$manager = $this->manager->getManager();

		$store = $manager->query('INSERT INTO posts(title, content, published, date_creation, theme_id, picture_url) VALUES( NULL,  NULL, 1, NOW(), 0, NULL)') or die(print_r($manager->errorMessage()));
	}

	/**
	* Return the id of the last post stored
	**/
	public function maxPostID(){

		$manager = $this->manager->getManager();

		$post = $manager->query('SELECT MAX(ID) FROM posts') or die(print_r($manager->errorMessage())); 

		$maxId = $post->fetch(); 

		return $maxId; 
	}
	
	/**
	* update post  
	**/
	public function updatePosts($id, $title, $content){

		$manager = $this->manager->getManager();

		$updatePost = $manager->prepare('UPDATE posts SET title = ?, content = ?, updated_at = NOW() WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$updatePost->execute(array($title, $content, $id)); 
	}

	/**
	* Publish articles or keep them private
	**/
	public function changePublish($publish, $id) {

		$manager = $this->manager->getManager();

		$publishPost = $manager->prepare('UPDATE posts SET published = ? WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$publishPost->execute(array($publish, $id));
	}

	// update picture

	public function updatePostPicture($id, $url) {

		$manager = $this->manager->getManager();

		$postPicture = $manager->prepare("UPDATE posts SET picture_url = ? WHERE ID = ?") or die(print_r($manager->errorMessage()));

		$postPicture->execute(array($url, $id));

	}

	/**
	* delete post 
	**/
	public function delete($id) {

		$manager = $this->manager->getManager();

		$destroy = $manager->prepare('DELETE FROM posts WHERE ID = ?') or die(print_r($manager->errorMessage()));

		$destroy->execute(array($id)); 
	}

}

