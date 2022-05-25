<?php

class ContactGroup {

    private $Group_id;
    private $Contact_id;

    public function __construct()
    {
        
    }



    /**
     * Get the value of Group_id
     */ 
    public function getGroup_id()
    {
        return $this->Group_id;
    }

    /**
     * Set the value of Group_id
     *
     * @return  self
     */ 
    public function setGroup_id($Group_id)
    {
        $this->Group_id = $Group_id;

        return $this;
    }

    /**
     * Get the value of Contact_id
     */ 
    public function getContact_id()
    {
        return $this->Contact_id;
    }

    /**
     * Set the value of Contact_id
     *
     * @return  self
     */ 
    public function setContact_id($Contact_id)
    {
        $this->Contact_id = $Contact_id;

        return $this;
    }
}