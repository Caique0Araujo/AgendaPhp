<?php

namespace Agenda\Views\ContactsEvents;

class ContactsEventView{
    public function addForm($event, $contacts){
        $title = 'Adicionar contatos';
        require_once './views/ContactsEvents/addContactEvent.phtml';
    }
    public function add($message){
        $title = 'Adicionar contatos';
        $content = '';
        require_once './Views/templates/main.phtml';
    }
    public function editForm($contacts, $event){
        $title = 'Editar contatos';
        require_once './Views/ContactsEvents/editContactEvent.phtml';
    }
    
    
}