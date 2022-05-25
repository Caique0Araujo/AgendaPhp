<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContato;
use Agenda\Models\Contato;
use Agenda\Views\Contacts\ContactView;


class ControllerContact
{
    public function __construct()
    {
    }

    public function indexAll()
    {
        $view = new ContactView();
        $view->dataContainer();
    }

    public function indexOne()
    {
    }

    public function store()
    {
        $view = new ContactView();
        $view->addForm();
    }
    public function storeSave($name, $fone, $email)
    {

        $contato = new Contato();
        $contato->setNome($name);
        $contato->setFone($fone);
        $contato->setEmail($email);

        $dao = new DaoContato();
        $dao->inclui($contato);


        $view = new ContactView();
        $view->dataContainer();
    }
    public function update()
    {
        $view = new ContactView();
        $view->editForm();
    }
    public function delete()
    {
    }
}
