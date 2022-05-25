<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\Contact;
use PDOException;


class DaoContact
{

    public function getAll($User_id)
    {
        try {

            $sql =
                'SELECT contacts.id, contacts.name, contacts.email, contacts.fone 
            FROM contacts 
            WHERE contacts.Users_id = ? 
            AND contacts.active = 1;';

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

    public function getByGroup($Group_id)
    {

        try {
            $sql =
                'SELECT contacts.id, contacts.name, contacts.email, contacts.fone 
        FROM contacts AS c 
        INNER JOIN groups_has_contacts AS gc ON c.id = gc.Contacts_id 
        WHERE gc.Groups_id = ? 
        AND c.active = 1;';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $Group_id);
            $pst->execute();

            $lista = [];
            $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getByEvent($Event_id)
    {
        try {
            $sql =
                'SELECT * 
        FROM contacts AS c 
        INNER JOIN events_has_contacts AS ec ON c.id = ec.contacts_id 
        WHERE ec.Events_id = ? 
        AND c.active = 1;';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $Event_id);

            $pst->execute();
            $lista = [];
            $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {
            $sql = 
            'SELECT contacts.name, contacts.email, contacts.fone
            FROM contacts 
            WHERE id = ? 
            AND active = 1';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);
            $pst->execute();

            $pst->setFetchMode(PDO::FETCH_CLASS, 'Contact');
            $contact = new Contact();
            $contact = $pst->fetch();
            return $contact;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create(Contact $contact)
    {

        try {
            $sql =
                'INSERT INTO contacts(name, email, fone, Users_id) 
        VALUES (?, ?, ?, ?)';

            $pst = Connection::getPreparedStatement($sql);

            $fone = null;
            if ($contact->getFone() != null) {
                $fone = $contact->getFone();
            }
            $email = null;
            if($contact->getEmail != null){
                $fone = $contact->getEmail();
            }

            $pst->bindValue(1, $contact->getName());
            $pst->bindValue(2, $fone);
            $pst->bindValue(3, $email);
            $pst->bindValue(4, $contact->getUser_id());

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id, $User_id)
    {

        try {
            $sql =
                'UPDATE contacts 
        SET active = 0
        WHERE id = ?
        AND Users_id = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);
            $pst->bindValue(2, $User_id);

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update(Contact $c)
    {

        try {
            $sql =
                'UPDATE contacts 
        SET name = ?, fone = ?, email = ? 
        WHERE id = ?
        AND Users_id = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $c->getName());
            $pst->bindValue(2, $c->getFone());
            $pst->bindValue(3, $c->getEmail());
            $pst->bindValue(4, $c->getId());
            $pst->bindValue(5, $c->getUser_id());

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isEmpty($User_id)
    {
        try {
            $sql =
                'SELECT * 
        FROM contacts
        WHERE Users_id = ?
        AND active = 1';
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

    public function isActive($id){
        try {

            $sql = 
            'SELECT contacts.active
            FROM contacts
            WHERE id = ?';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $id);
            $pst->execute();
            
            if ($pst->rowCount() < 1)
                return false;
            else
                return true;

            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function active($id, $User_id){
        try {
            $sql =
                'UPDATE contacts 
        SET active = 1
        WHERE id = ?
        AND Users_id = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);
            $pst->bindValue(2, $User_id);

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
