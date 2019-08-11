<?php

namespace Model\Comment;


class Comment {

	protected $id;
	protected $post_id;
	protected $author;
	protected $mail;
	protected $content;
	protected $date_comment;
	protected $reported;
	protected $ridden;
	protected $replied;

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
	public function getPost_id() { return $this->post_id; }
	public function getAuthor() { return $this->author; }
	public function getMail() { return $this->mail; }
	public function getContent() { return $this->content; }
	public function getDate_comment() { return $this->date_comment; }
	public function getReported() { return $this->reported; }
	public function getRidden() { return $this->ridden; }
	public function getReplied() { return $this->replied; }


	public function setId($id){

		$id = (int) $id; 

		$this->id = $id; 
	}

	public function setPost_id($post_id){

		$post_id = (int) $post_id; 

		$this->post_id = $post_id; 
	}

	public function setAuthor($author){

		$this->author = $author;
	}

	public function setMail($mail){

		$this->mail = $mail;
	}

	public function setContent($content){

		$this->content = $content;
	}

	public function setDate_comment($date_comment){

		$this->date_comment = $date_comment;
	
	}

	public function setReported($reported){

		$this->reported = $reported;
	
	}

	public function setRidden($ridden){

		$this->ridden = $ridden;
	
	}

	public function setReplied($replied){

		$this->replied = $replied;
	
	}

}