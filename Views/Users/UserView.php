<?php

namespace Agenda\Views\Users;

class UserView
{
    public function __construct()
    {
    }
    public function render()
    {
        $title = 'Users';
        $content = '';
        require_once './Views/templates/main.phtml';
    }
    public function addForm(){
        $title = 'Registrar';
        $content = file_get_contents('./views/Users/register.html');
        require_once './Views/templates/main.phtml';
    }
    public function editForm($user){
        $title = 'Editar Usuário';
        require_once './views/Users/editUser.phtml';
    }
    public function login(){
        $title = 'Login';
        $content = file_get_contents('./views/Users/login.html');
        require_once './Views/templates/main.phtml';
    }
}
