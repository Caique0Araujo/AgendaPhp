<?php

namespace Agenda\Dao;

use PDOException;
use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\User;

class DaoUser
{

    // It can be email aswell
    public function login($login)
    {

        try {
            $sql =
                "SELECT id, active 
        FROM users 
        where (users.login = ? OR users.email = ?) AND users.active = 1";

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $login);
            $pst->bindValue(2, $login);
            $pst->execute();
            if ($pst->rowCount() > 0) {
                $dado = $pst->fetch();
                session_start();
                $_SESSION['id'] = $dado['id'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getAll()
    {

        try {
            $sql =
                'SELECT  users.id, users.name, users.login, users.email, users.password, users.fone, users.active
        FROM users';

            $pst = Connection::getPreparedStatement($sql);
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
        $user = new User();

            $sql =
                'SELECT users.id, users.name, users.login, users.email, users.password, users.fone, users.active 
        FROM users 
        WHERE id = ?';

            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);
            $pst->execute();
            
            $pst->setFetchMode(PDO::FETCH_CLASS, "User");
            $user = $pst->fetch();
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function authLogin($login, $password)
    {

        try {
            $sql =
                'SELECT users.password 
        FROM users 
        WHERE (users.login = ? OR users.email = ?);';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $login);
            $pst->bindValue(2, $login);
           // $pst->bindValue(3, $password);

            $pst->execute();

            if ($pst->rowCount() < 1)
                return false;


            $passwordBd = $pst->fetch(PDO::FETCH_COLUMN);

            if(password_verify($password, $passwordBd))
                return true;
            
            return false;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getIdByLogin($login)
    {

        try {
            $sql =
                'SELECT id 
        FROM users 
        WHERE users.login = ? OR users.email = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $login);
            $pst->bindValue(2, $login);

            if ($pst->execute()) {
                $id = $pst->fetch(PDO::FETCH_COLUMN);
                return $id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPasswordByLogin($login){
        try {
            $sql = 
            'SELECT users.password 
            FROM users
            WHERE users.login = ? OR users.email = ?';

            $pst = Connection::getPreparedStatement($sql);
            $pst->bindValue(1, $login);
            $pst->bindValue(2, $login);
            $pst->execute();
            $password = $pst->fetch(PDO::FETCH_COLUMN);
            return $password;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function create(User $user)
    {

        try {
            $sql =
                'INSERT 
        INTO users (name, login, password, email, fone) 
        values (?, ?, ?, ?, ?)';
            $pst = Connection::getPreparedStatement($sql);

            $fone = null;
            if ($user->getFone() != null) {
                $fone = $user->getFone();
            }

            $pst->bindValue(1, $user->getName());
            $pst->bindValue(2, $user->getLogin());
            $pst->bindValue(3, $user->getPassword());
            $pst->bindValue(4, $user->getEmail());
            $pst->bindValue(5, $fone);

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function update(User $user)
    {

        try {
            $fone = null;
            if ($user->getFone() != null) {
                $fone = $user->getFone();
            }

            $sql =
                'UPDATE users 
            SET users.nome = ?, 
            users.login = ?, 
            users.password = ?, 
            users.fone = ?, 
            users.email = ?, 
            where id = ?';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $user->getName());
            $pst->bindValue(2, $user->getLogin());
            $pst->bindValue(3, $user->getPassword());
            $pst->bindValue(4, $fone);
            $pst->bindValue(5, $user->getEmail());
            $pst->bindValue(6, $user->getId());

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {

        try {
            $sql =
                'UPDATE users
        SET active = 0 
        WHERE id = ? ';
            $pst = Connection::getPreparedStatement($sql);

            $pst->bindValue(1, $id);

            if ($pst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function verifyPassword($password, $login){
        $sql = 
        'SELECT users.password
        FROM users
        WHERE login = ? OR email = ?';
        $pst = Connection::getPreparedStatement($sql);
        $pst->bindValue(1, $login);
        $pst->bindValue(2, $login);
        $pst->execute();

        $bdPassword = $pst->fetch(PDO::FETCH_COLUMN);
        if(password_verify($password, $bdPassword)){
            return true;
        }
        return false;
    

    }

 /*   public function excluir($id)
    {

        $sql =
            '
        DELETE ec.* FROM grupos_has_contatos AS ec INNER JOIN contatos as c ON c.id = ec.Contatos_id where c.Usuarios_id = ' . $id . ';
        DELETE ec.* FROM eventos_has_contatos AS ec INNER JOIN contatos as c ON c.id = ec.Contatos_id where c.Usuarios_id = ' . $id . ';
        DELETE FROM contatos where Usuarios_id = ' . $id . ';
        DELETE FROM frupos where Usuarios_id = ' . $id . ';
        DELETE FROM eventos where Usuarios_id = ' . $id . ';
        DELETE FROM usuarios where id = ' . $id . ';
        ';

        $pst = Connection::getPreparedStatement($sql);

        if ($pst->execute()) {
            return true;
        } else {
            return false;
        }
    }*/

    public function isActive($id){
        try {

            $sql = 
            'SELECT users.active
            FROM users
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
}
