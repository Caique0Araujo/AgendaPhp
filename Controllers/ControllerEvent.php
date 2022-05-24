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
