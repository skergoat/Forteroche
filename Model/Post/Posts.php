<?php

namespace Model\Post;


class Posts {

	protected $id;
	protected $title;
	protected $content;
	protected $published;
	protected $date_creation;
	protected $updated_at;
	protected $theme_id;
	protected $picture_url;

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
	public function getTitle() { return $this->title; }
	public function getContent() { return $this->content; }
	public function getPublished() { return $this->published; }
	public function getDate_creation() { return $this->date_creation; }
	public function getUpdated_at() { return $this->updated_at; }
	public function getTheme_id() { return $this->theme_id; }
	public function getPicture_url() { return $this->picture_url; }


	public function setId($id){

		$id = (int) $id; 

		$this->id = $id; 
	}

	public function setTitle($title){ 

		$this->title = $title;
	}

	public function setContent($content){

		$this->content = $content;
	}

	public function setPublished($published){

		$this->published = $published;
	
	}

	public function setDate_creation($date_creation){

		$this->date_creation = $date_creation;
	
	}

	public function setUpdated_at($updated_at){

		$this->updated_at = $updated_at;
	
	}

	public function setTheme_id($theme_id){

		$this->theme_id = $theme_id;
	
	}

	public function setPicture_url($picture_url){

		$this->picture_url = $picture_url;
	
	}

}