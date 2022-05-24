<?php

namespace Agenda\Controllers;

use Agenda\Views\Groups\GroupView;

class ControllerGroup
{
    public function __construct()
    {
    }
    public function indexAll()
    {
        $view = new GroupView();
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
