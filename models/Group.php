<?php

class Grupo{

    private $id;
    private $name;     
    private $description;
    private $User_id;

    public function __construct()
    {
        
    }

    
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of User_id
     */ 
    public function getUser_id()
    {
        return $this->User_id;
    }

    /**
     * Set the value of User_id
     *
     * @return  self
     */ 
    public function setUser_id($User_id)
    {
        $this->User_id = $User_id;

        return $this;
    }
}


