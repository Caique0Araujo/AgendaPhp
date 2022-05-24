<?php

namespace Agenda\Controllers;

use Agenda\Views\Events\EventView;

class ControllerEvent
{
    public function __construct()
    {
    }

    public function indexAll()
    {
        $view = new EventView();
        $view->dataContainer();
    }

    public function indexOne()
    {
    }

    public function store()
    {
        $view = new EventView();
        $view->addForm();
    }
    public function update()
    {
        $view = new EventView();
        $view->editForm();
    }
    public function delete()
    {
    }
}
