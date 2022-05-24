<?php

class Contato {

    private $idcon;
    private $nome;
    private $fone;
    private $email;
    private $Usuario_id;


    public function __construct()
    {
        
    }

    public function setIdcon($idcon)
    {
        $this->idcon = $idcon;

        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function setFone($fone)
    {
        $this->fone = $fone;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getIdcon()
    {
        return $this->idcon;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function getFone()
    {
        return $this->fone;
    }

    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Get the value of Usuario_id
     */ 
    public function getUsuario_id()
    {
        return $this->Usuario_id;
    }

    /**
     * Set the value of Usuario_id
     *
     * @return  self
     */ 
    public function setUsuario_id($Usuario_id)
    {
        $this->Usuario_id = $Usuario_id;

        return $this;
    }
}