<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Dao\DaoContactGroup;
use Agenda\Dao\DaoGroup;
use Agenda\Models\ContactGroup;
use Agenda\Views\ContactsGroups\ContactsGroupView;

class ControllerContactGroup{
    public function store($id)
    {
        $groupDao = new DaoGroup();
        $contactDao = new DaoContact();
        $group = $groupDao->getById($id, $_SESSION['id']);
        $contacts = $contactDao->getAll($_SESSION['id']);

        $view = new ContactsGroupView();
        $view->addForm($group, $contacts);
    }

    public function storeSave($groupId, $contacts){

        $dao = new DaoContactGroup();
        $gId = $dao->getByGroup($groupId, $_SESSION['id']);
        
        for($i = 0; $i < count($contacts); $i++){
            $cId = $dao->getByContact($contacts[$i], $_SESSION['id']);
            if(isset($gId[$i]) && isset($cId)){
                $message = 'Contato já cadastrado no grupo.';
            }
            $gc = new ContactGroup();
            $gc->setGroup_id($gId);
            $gc->setContact_id($cId);
            $gc->setUser_id($_SESSION['id']);
            $dao->create($gc);
        }
    }

    public function update($id)
    {
        $groupDao = new DaoGroup();
        $group = $groupDao->getById($id, $_SESSION['id']);
        $dao = new DaoContactGroup();
        $view = new ContactsGroupView();
        $view->editForm();
    }
}