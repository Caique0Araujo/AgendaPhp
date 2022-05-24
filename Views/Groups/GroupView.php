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
        $content = '';
        require_once './Views/templates/main.phtml';
    }
    public function addForm(){
        $title = 'Adicionar Grupo';
        $content = file_get_contents('./views/Groups/addGroup.html');
        require_once './Views/templates/main.phtml';
    }
    public function editForm(){
        $title = 'Editar Grupo';
        $content = file_get_contents('./views/Groups/editGroups.html');
        require_once './Views/templates/main.phtml';
    }
    public function dataContainer(){
        $title = 'Grupo';
        $content = file_get_contents('./views/Groups/Groups.html');
        require_once './Views/templates/main.phtml';
    }
}
