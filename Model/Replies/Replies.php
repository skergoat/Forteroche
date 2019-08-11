<?php

namespace Model\Replies;


class Replies {

	protected $id;
	protected $comment_id;
	protected $post_id;
	protected $user_admin;
	protected $user_name;
	protected $user_mail;
	protected $reply;
	protected $created_at;

	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}


	public function hydrate(array $donnees)
	{
	  foreach ($donnees as $key => $value)
	  {
	    $method = 'set'.ucfirst($key);
	        
	    if (method_exists($this, $method))
	    {
	      $this->$method($value);
	    }
	  }
	}


	public function getId() { return $this->id; }
	public function getComment_id() { return $this->comment_id; }
	public function getPost_id() { return $this->post_id; }
	public function getUser_admin() { return $this->user_admin; }
	public function getUser_name() { return $this->user_name; }
	public function getUser_mail() { return $this->user_mail; }
	public function getReply() { return $this->reply; }
	public function getCreated_at() { return $this->created_at; }


	public function setId($id){

		$id = (int) $id; 

		$this->id = $id; 
	}

	public function setComment_id($comment_id){ 

		$this->comment_id = $comment_id;
	}

	public function setPost_id($post_id){

		$this->post_id = $post_id;
	}

	public function setUser_admin($user_admin){

		$this->user_admin = $user_admin;
	
	}

	public function setUser_name($user_name){

		$this->user_name = $user_name;
	
	}

	public function setUser_mail($user_mail){

		$this->user_mail = $user_mail;
	
	}

	public function setReply($reply){

		$this->reply = $reply;
	
	}

	public function setCreated_at($created_at){

		$this->created_at = $created_at;
	
	}

}