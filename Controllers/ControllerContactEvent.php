<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContactEvent;
use Agenda\Views\ContactsEvents\ContactsEventView;

class ControllerContactEvent{
    public function store()
    {
        $view = new ContactsEventView();
        $view->addForm();
    }
    public function update()
    {
        $dao = new DaoContactEvent();
        $view = new ContactsEventView();
        $view->editForm();
    }
}