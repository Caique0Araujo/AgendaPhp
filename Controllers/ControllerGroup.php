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
        $view->dataContainer();
    }

    public function indexOne()
    {
    }

    public function store()
    {
        $view = new GroupView();
        $view->addForm();
    }
    public function update()
    {
        $view = new GroupView();
        $view->editForm();
    }
    public function delete()
    {
    }
}
