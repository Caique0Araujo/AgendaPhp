<?php

namespace Agenda\Views\Contacts;

class ContactView
{
    public function __construct()
    {
    }
    public function render()
    {
        $title = 'Contact';
        require_once './Views/templates/main.phtml';
    }

    public function form(){
        $content = file_get_contents('./views/Contacts/addContact.html');
        $title = 'Adicionar contatos';
        require_once './Views/templates/main.phtml';
    }
}
