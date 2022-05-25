<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Models\Contact;
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

        $con = new Contact();
        $con->setName($name);
        $con->setFone($fone);
        $con->setEmail($email);

        $dao = new DaoContact();
        $dao->create($con);


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
