<?php

class ContatoEvento {
    private  $Eventos_id;
    private $Contatos_id;

    public function __construct()
    {
        
    }

    /**
     * Get the value of Eventos_id
     */ 
    public function getEventos_id()
    {
        return $this->Eventos_id;
    }

    /**
     * Get the value of Contatos_id
     */ 
    public function getContatos_id()
    {
        return $this->Contatos_id;
    }

    /**
     * Set the value of Eventos_id
     *
     * @return  self
     */ 
    public function setEventos_id($Eventos_id)
    {
        $this->Eventos_id = $Eventos_id;

        return $this;
    }

    /**
     * Set the value of Contatos_id
     *
     * @return  self
     */ 
    public function setContatos_id($Contatos_id)
    {
        $this->Contatos_id = $Contatos_id;

        return $this;
    }
}