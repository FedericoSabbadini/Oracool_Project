<?php

class Author
{
    private $id;
    private $firstName; 
    private $lastName;
    
    public function __construct($identifier, $first_name, $last_name)
    {
        $this->id = $identifier;
        $this->firstName = $first_name;
        $this->lastName = $last_name;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setId($identifier)
    {
        $this->id = $identifier;
    }
    
    public function setFirstName($first_name)
    {
        $this->firstName = $first_name;
    }
    
    public function setLastName($last_name)
    {
        $this->lastName = $last_name;
    }    
}