<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Dao\DaoEvent;
use Agenda\Dao\DaoContactEvent;
use Agenda\Dao\DaoGroup;
use Agenda\Models\ContactEvent;
use Agenda\Views\ContactsEvents\ContactsEventView;

class ControllerContactEvent{
    public function store($id)
    {
        $eventDao = new DaoEvent();
        $contactDao = new DaoContact();
        $event = $eventDao->getById($id, $_SESSION['id']);
        $contacts = $contactDao->getAll($_SESSION['id']);

        $view = new ContactsEventView();
        $view->addForm($event, $contacts);
    }

    public function storeSave($eventId, $contacts){
        $dao = new DaoContactEvent();

        for($i = 0; $i < sizeof($contacts); $i++){
            if(!$dao->exists($eventId[1], $contacts[$i], $_SESSION['id'])){
                print_r($eventId[1]);
                $ec = new ContactEvent();
                $ec->setEvent_id($eventId[1]);
                $ec->setContact_id($contacts[$i]);
                $ec->setUser_id($_SESSION['id']);

                $dao->create($ec);
            }
        }
    }


    public function update($id)
    {

        $daoContact = new DaoContact();
        $contacts = $daoContact->getByEvent($id, $_SESSION['id']);
        $daoEvent = new DaoEvent();
        $event = $daoEvent->getById($id, $_SESSION['id']);
        $view = new ContactsEventView();
        $view->editForm($contacts, $event);
    }

    public function updateSave($event, $contacts){
        $daoEvent = new DaoEvent();
        $daoEC = new DaoContactEvent();

        for($i = 0; $i < sizeof($contacts); $i++){
            $daoEC->delete($event, $contacts[$i], $_SESSION['id']);
        }
    }
}