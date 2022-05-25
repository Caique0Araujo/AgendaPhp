<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\ContactGroup;
use PDOException;


class DaoContactGroup
{

    public function getAll($User_id)
    {

        try {
            $sql =
                'SELECT groups_has_contacts.Groups_id, groups_has_contacts.Contacts_id
        FROM groups_has_contacts
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

    public function getByGroup($id, $User_id)
    {
        $sql = 
        'SELECT groups_has_contacts.Groups_id, groups_has_contacts.Contacts_id
        FROM groups_has_contacts 
        WHERE Groups_id = ? 
        AND Users_id = ?;';
        $pst = Connection::getPreparedStatement($sql);
        $pst->bindValue(1, $id);
        $pst->bindValue(2, $User_id);
        $pst->execute();
        $list = [];
        $list = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function create(ContactGroup $contactGroup)
    {

        $sql = 
        'INSERT 
        INTO groups_has_contacts(Contacts_id, Groups_id, Users_id) 
        VALUES (?, ?, ?)';

        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $contactGroup->getGroup_id());
        $pst->bindValue(2, $contactGroup->getContact_id());
        $pst->bindValue(3, $contactGroup->getUser_id());


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
        FROM groups_has_contacts 
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

    public function deleteByGroup($id, $User_id)
    {

        $sql = 
        'DELETE 
        FROM groups_has_contacts 
        WHERE Groups_id = ?
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

    public function delete($Group_id, $Contact_id, $User_id)
    {

        $sql = 
        'DELETE 
        FROM groups_has_contacts 
        WHERE Groups_id = ?
        AND Contacts_id = ?
        AND Users_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $Group_id);
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
        FROM groups_has_contacts
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
