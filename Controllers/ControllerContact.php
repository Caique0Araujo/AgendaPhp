<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Models\Contact;
use Agenda\Views\Contacts\ContactView;
use Agenda\Views\HomeView;

class ControllerContact
{
    public function __construct()
    {
    }

    public function indexAll()
    {
        $view = new ContactView();
        $contacts = [];
        $dao = new DaoContact();
        $contacts = $dao->getAll($_SESSION['id']);
        $view->dataContainer($contacts);
    }
    public function indexHome()
    {
        $view = new HomeView();
        $contacts = [];
        $dao = new DaoContact();
        $contacts = $dao->getAll($_SESSION['id']);
        $view->render($contacts);
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
        $con->setUser_id($_SESSION['id']);

        $dao = new DaoContact();
        $dao->create($con);

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

    }

    public function delete($id)
    {
        $dao = new DaoContact();
        $dao->delete($id, $_SESSION['id']);
    }
}
