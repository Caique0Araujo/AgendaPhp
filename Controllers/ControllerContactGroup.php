<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Dao\DaoContactGroup;
use Agenda\Dao\DaoGroup;
use Agenda\Models\ContactGroup;
use Agenda\Views\ContactsGroups\ContactsGroupView;
use Agenda\Views\Groups\GroupView;

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

        
        for($i = 0; $i < sizeof($contacts); $i++){
            
            if(!$dao->exists($groupId, $contacts[$i], $_SESSION['id'])){
                $gc = new ContactGroup();
                $gc->setGroup_id($groupId);
                $gc->setContact_id($contacts[$i]);
                $gc->setUser_id($_SESSION['id']);
    
                $dao->create($gc);
            }
           
        }
    }

    public function update($id)
    {
        $daoContact = new DaoContact();
        $contacts = $daoContact->getByGroup($id, $_SESSION['id']);
        $daoGroup = new DaoGroup();
        $group = $daoGroup->getById($id, $_SESSION['id']);
        $view = new ContactsGroupView();
        $view->editForm($contacts, $group);
    }

    public function updateSave($group, $contacts){

        $daoGroup = new DaoGroup();
        $daoGC = new DaoContactGroup();

        for($i = 0; $i < sizeof($contacts); $i++){
           $daoGC->delete($group, $contacts[$i], $_SESSION['id']);
        }

    }
}