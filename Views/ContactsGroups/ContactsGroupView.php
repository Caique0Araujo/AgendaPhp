<?php

namespace Agenda\Views\ContactsGroups;

class ContactsGroupView{
    public function addForm($group, $contacts){
        $title = 'Adicionar contatos';
        require_once './views/ContactsGroups/addContactGroup.phtml';
    }
    public function editForm(){
        $title = 'Editar contatos';
        require_once './Views/ContactsGroups/editContactGroup.phtml';
    }
    
}