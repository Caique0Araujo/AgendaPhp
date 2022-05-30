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
        $content = '';
        require_once './Views/templates/main.phtml';
    }

    public function addForm(){
        $title = 'Adicionar contato';
        $content = file_get_contents('./views/Contacts/addContact.html');
        require_once './Views/templates/main.phtml';
    }
    public function editForm($contact){
        $title = 'Editar contato';
        $content = file_get_contents('./views/Contacts/editContact.html');
        require_once './Views/templates/main.phtml';
    }
    public function dataContainer(){
        $title = 'Contatos';
        $content = file_get_contents('./views/Contacts/Contacts.html');
        require_once './Views/templates/main.phtml';
    }
}
