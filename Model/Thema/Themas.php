<?php

namespace Model\Thema;


class Themas
{
	
	protected $id; 
	protected $theme_label;


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
	public function getTheme_label() { return $this->theme_label; }



	public function setId($id) { 

		$this->id = $id; 
	}

	public function setTheme_label($theme_label) { 

		$this->theme_label = $theme_label; 
	}
	

}