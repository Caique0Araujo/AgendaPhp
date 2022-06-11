<?php

namespace Agenda\Views\ContactsGroups;

class ContactsGroupView{
    public function addForm($group, $contacts){
        $title = 'Adicionar contatos';
        require_once './views/ContactsGroups/addContactGroup.phtml';
    }

    public function add($message){
        $title = 'Adicionar contatos';
        $content = '';
        require_once './Views/templates/main.phtml';
    }

    public function editForm($contacts, $group){
        $title = 'Editar contatos';
        require_once './Views/ContactsGroups/editContactGroup.phtml';
    }

    public function teste($id){
        $content = $id;
        require_once './Views/templates/main.phtml';
    }
    
}