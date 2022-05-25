<?php

namespace Agenda\Models;


class Contact {

    private $id;
    private $name;
    private $fone;
    private $email;
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
     * Get the value of fone
     */ 
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * Set the value of fone
     *
     * @return  self
     */ 
    public function setFone($fone)
    {
        $this->fone = $fone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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