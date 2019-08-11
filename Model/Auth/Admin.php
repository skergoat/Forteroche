<?php 

namespace Model\Auth;


class Admin 
{

	protected $id;
	protected $name;
	protected $password;
	protected $email;


	public function __construct(array $donnees) {

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
	public function getName() { return $this->name; }
	public function getPassword() { return $this->Password; }
	public function getEmail() { return $this->email; }


	public function setId($id) {

		$this->id = $id;
	}

	public function setName($name) {

		$this->name = $name;
	}

	public function setPassword($password) {

		$this->password = $password;
	}

	public function setEmail($email) {

		$this->email = $email;
	}

}