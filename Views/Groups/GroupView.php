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
    public function editForm($group){
        $title = 'Editar Grupo';
        require_once './Views/Groups/editGroup.phtml';
    }
    public function dataContainer($groups){
        $title = 'Grupos';
        require_once './Views/Groups/Groups.phtml';
    }
}
