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
        $content = '';
        require_once './Views/templates/main.phtml';
    }
    public function addForm(){
        $title = 'Adicionar Evento';
        $content = file_get_contents('./views/Eventos/addEvent.html');
        require_once './Views/templates/main.phtml';
    }
    public function editForm(){
        $title = 'Editar Evento';
        $content = file_get_contents('./views/Eventos/editEvent.html');
        require_once './Views/templates/main.phtml';
    }
    public function dataContainer(){
        $title = 'Eventos';
        $content = file_get_contents('./views/Events/Events.html');
        require_once './Views/templates/main.phtml';
    }
}
