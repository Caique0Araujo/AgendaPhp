<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use ContactGroup;

class DaoContatoGrupo
{

    public function getAll()
    {

        $list = [];
        $pst = Connection::getPreparedStatement('select * from groups_has_contacts');
        $pst->execute();
        $list = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function getByGroup($id)
    {
        $list = [];
        $pst = Connection::getPreparedStatement('select * from groups_has_contacts where Grupos_id =' . $id . ';');
        $pst->execute();
        $list = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    public function create(ContactGroup $contactGroup)
    {

        $sql = 'insert into groups_has_contacts(Contatos_id, Grupos_id) values (?, ?)';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $contactGroup->getGroup_id());
        $pst->bindValue(2, $contactGroup->getContact_id());


        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteByContact($id)
    {

        $sql = 'delete from groups_has_contacts where Contatos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteByGroup($id)
    {

        $sql = 'delete from groups_has_contacts where Grupos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($idGrupo, $idContato)
    {

        $sql = 'delete from groups_has_contacts where Grupos_id = ? and Contatos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $idGrupo);
        $pst->bindValue(2, $idContato);
        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty()
    {

        $pst = Connection::getPreparedStatement('select * from groups_has_contacts');
        $pst->execute();
        if ($pst->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
