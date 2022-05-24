<?php

namespace Agenda\Views\Events;

class EventView
{
    public function __construct()
    {
    }
    public function render()
    {
        $title = 'Eventos';
        require_once './Views/templates/main.phtml';
    }
}
