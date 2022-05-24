<?php

namespace Agenda\Controllers;

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
    public function update()
    {
        $view = new ContactView();
        $view->editForm();
    }
    public function delete()
    {
    }
}
