<?php

namespace Agenda\Views\ContactsEvents;

class ContactsEventView{
    public function addForm(){
        $title = 'Adicionar contatos';
        require_once './views/ContactsEvents/addContactEvent.phtml';
    }
    public function editForm(){
        $title = 'Editar contatos';
        require_once './Views/ContactsEvents/editContactEvent.phtml';
    }
    
}