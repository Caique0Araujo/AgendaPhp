<?php

namespace Agenda\Controllers;

use Agenda\Dao\DaoContact;
use Agenda\Dao\DaoEvent;
use Agenda\Dao\DaoContactEvent;
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
        $daoEvent = new DaoEvent();

        $event = $daoEvent->getById($eventId);

        for($i = 0; $i < sizeof($contacts); $i++){

            print_r($event->getId());
            

            if(!$dao->exists($event->getId(), $contacts[$i], $_SESSION['id'])){
                $ec = new ContactEvent();
                $ec->setEvent_id($event->getId());
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