<?php

namespace Agenda\Views\Contacts;

use Agenda\Dao\DaoContact;

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
        require_once './views/Contacts/editContact.phtml';
    }
    public function dataContainer($contacts){
        $title = 'Contatos';
        require_once './views/Contacts/Contacts.phtml';
    }
}
