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
        $content = file_get_contents('./views/Events/addEvent.html');
        require_once './Views/templates/main.phtml';
    }
    public function editForm($event){
        $title = 'Editar Evento';
        require_once './views/Events/editEvent.phtml';
    }
    public function dataContainer($events){
        $title = 'Eventos';
        require_once './views/Events/Events.phtml';
    }
}
