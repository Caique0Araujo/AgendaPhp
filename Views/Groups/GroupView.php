<?php

namespace Agenda\Views\Groups;

class GroupView
{
    public function __construct()
    {
    }
    public function render()
    {
        $title = 'Grupo';
        require_once './Views/templates/main.phtml';
    }
}
