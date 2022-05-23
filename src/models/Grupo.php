<?php

class Grupo{

    private $idgroup;
    private $nome;     
    private $descricao;
    private $Usuario_id;

    public function __construct()
    {
        
    }

    
    public function getIdgroup()
    {
        return $this->idgroup;
    }


    public function setIdgroup($idgroup)
    {
        $this->idgroup = $idgroup;

        return $this;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
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


