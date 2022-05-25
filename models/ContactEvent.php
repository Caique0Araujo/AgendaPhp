<?php

class ContactEvent {
    private  $Event_id;
    private $Contact_id;

    public function __construct()
    {
        
    }



    /**
     * Get the value of Event_id
     */ 
    public function getEvent_id()
    {
        return $this->Event_id;
    }

    /**
     * Set the value of Event_id
     *
     * @return  self
     */ 
    public function setEvent_id($Event_id)
    {
        $this->Event_id = $Event_id;

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