<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\Group;
use PDOException;

class DaoGroup
{

    public function getAll($User_id)
    {

        try {
            $sql =
            "SELECT groups.id, groups.name, groups.description, groups.active, groups.Users_id
            FROM groups 
            WHERE Users_id = ? 
            AND active = 1";

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

    public function getById($id, $User_id)
    {
        try {
            $sql =
            'SELECT groups.id, groups.name, groups.description, groups.active, groups.Users_id
            FROM groups 
            WHERE id = ? 
            AND Users_id = ?
            AND groups.active = 1';

            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);
            $pst->bindValue(2, $User_id);

            $pst->execute();

            $pst->setFetchMode(PDO::FETCH_CLASS, 'Agenda\Models\Group');
            $grupo = new Group();
            $grupo = $pst->fetch();
            return $grupo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create(Group $group)
    {

        try {
            $sql =
            'INSERT 
            INTO groups (name, description, Users_id) 
            values (?, ?, ?)';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $group->getName());
            $pst->bindValue(2, $group->getDescription());
            $pst->bindValue(3, $group->getUser_id());

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
            'UPDATE groups
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

    public function update(Group $group)
    {

        try {
            $sql =
            'UPDATE groups 
            SET groups.name = ?, groups.description = ? 
            WHERE groups.id = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $group->getName());
            $pst->bindValue(2, $group->getDescription());
            $pst->bindValue(3, $group->getId());

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isEmpty()
    {
        $pst = Connection::getPreparedStatement('select * from grupos');
        $pst->execute();

        if ($pst->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }
    public function isActive($id)
    {
        try {

            $sql =
                'SELECT groups.active
            FROM groups
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

    public function active($id, $User_id)
    {

        try {
            $sql =
                'UPDATE groups
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
