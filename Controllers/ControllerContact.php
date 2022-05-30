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
    public function update($id)
    {
        $dao = new DaoContact();
        $contact = $dao->getById($id);
        $view = new ContactView();
        $view->editForm($contact);
    }
    public function updateSave($id, $name, $fone, $email){
        $con = new Contact();

        $con->setId($id);
        $con->setName($name);
        $con->setEmail($email);
        $con->setFone($fone);
        $con->setUser_id($_SESSION['id']);

        $dao = new DaoContact();
        $dao->update($con);
        $view = new ContactView();
        $view->dataContainer();

    }

    public function delete($id)
    {
        $dao = new DaoContact();
        $dao->delete($id, $_SESSION['id']);
        $view = new ContactView();
        $view->dataContainer();
    }
}
