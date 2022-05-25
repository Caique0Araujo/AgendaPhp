<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\Contact;

class DaoContact
{

    public function getAll()
    {

        $lista = [];
        $pst = Connection::getPreparedStatement('select * from contacts');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function getByUser($id)
    {
        $lista = [];
        $sql = 'SELECT * FROM contacts WHERE User_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function getByGroup($id)
    {
        $lista = [];

        $sql = 'SELECT * FROM contacts AS c INNER JOIN groups_has_contacts AS gc ON c.id = gc.contacts_id WHERE Grupos_id = ?;';

        $pst = Connection::getPreparedStatement($sql);
        $pst->bindValue(1, $id);
        $pst->execute();

        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function getByEvent($id)
    {
        $lista = [];
        $pst = Connection::getPreparedStatement('SELECT * FROM contacts AS c INNER JOIN eventos_has_contacts AS ec ON c.id = ec.contacts_id WHERE Eventos_id = ' . $id . ';');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function getById($id)
    {

        $Contact = new Contact();
        $pst = Connection::getPreparedStatement('SELECT * FROM contacts WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Contact');
        $Contact = $pst->fetch();
        return $Contact;
    }

    public function create(Contact $Contact)
    {

        $sql = 'insert into contacts(nome, fone, email, Usuarios_id) values (?, ?, ?, ?)';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $Contact->getName());
        $pst->bindValue(2, $Contact->getFone());
        $pst->bindValue(3, $Contact->getEmail());
        $pst->bindValue(4, $Contact->getUser_id());

        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {

        $sql = 'delete from contacts where id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update(Contact $c)
    {

        $sql = 'update contacts set nome = ?, fone = ?, email = ? where id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $c->getName());
        $pst->bindValue(2, $c->getFone());
        $pst->bindValue(3, $c->getEmail());
        $pst->bindValue(4, $c->getId());

        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty()
    {
        $pst = Connection::getPreparedStatement('select * from contacts');
        $pst->execute();

        if ($pst->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }
}
