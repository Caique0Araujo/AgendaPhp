<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\ContactEvent;
use PDOException;


class DaoContactEvent
{

    public function getAll($User_id)
    {

        try {
            $sql =
                'SELECT events_has_contacts.Events_id, events_has_contacts.Contacts_id
        FROM events_has_contacts
        WHERE Users_id = ?
        AND active = 1';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $User_id);
            $pst->execute();
            $lista = [];
            $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getByEvent($id, $User_id)
    {
        $sql = 
        'SELECT events_has_contacts.Events_id, events_has_contacts.Contacts_id
        FROM events_has_contacts 
        WHERE Events_id = ? 
        AND Users_id = ?;';
        $pst = Connection::getPreparedStatement($sql);
        $pst->bindValue(1, $id);
        $pst->bindValue(2, $User_id);
        $pst->execute();
        $list = [];
        $list = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function create(ContactEvent $contactEvent)
    {

        $sql = 
        'INSERT 
        INTO events_has_contacts(Contacts_id, Events_id, Users_id) 
        VALUES (?, ?, ?)';

        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $contactEvent->getevent_id());
        $pst->bindValue(2, $contactEvent->getContact_id());
        $pst->bindValue(3, $contactEvent->getUser_id());


        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteByContact($id, $User_id)
    {

        $sql = 
        'DELETE 
        FROM events_has_contacts 
        WHERE Contacts_id = ?
        AND Users_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        $pst->bindValue(2, $User_id);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteByEvent($id, $User_id)
    {

        $sql = 
        'DELETE 
        FROM events_has_contacts 
        WHERE Events_id = ?
        AND Users_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        $pst->bindValue(2, $User_id);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($event_id, $Contact_id, $User_id)
    {

        $sql = 
        'DELETE 
        FROM events_has_contacts 
        WHERE Events_id = ?
        AND Contacts_id = ?
        AND Users_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $event_id);
        $pst->bindValue(2, $Contact_id);
        $pst->bindValue(3, $User_id);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty($User_id)
    {
        try {
            $sql =
                'SELECT * 
        FROM events_has_contacts
        WHERE Users_id = ?';
        
            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $User_id);
            $pst->execute();

            if ($pst->rowCount() < 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
