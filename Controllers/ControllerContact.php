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
        $view->render();
    }

    public function indexOne()
    {
    }

    public function store()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
