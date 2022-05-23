<?php

class ContatoGrupo {

    private $idgroup;
    private $idcon;

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

    public function getIdcon()
    {
        return $this->idcon;
    }

    public function setIdcon($idcon)
    {
        $this->idcon = $idcon;

        return $this;
    }
}