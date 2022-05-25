<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;
use Agenda\Models\Group;

class DaoGrupo {

    public function getAll(){

        $lista = [];
        $pst = Connection::getPreparedStatement('select * from grupos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function getByUser($id){
        $lista = [];
        $sql = 'select * from grupos where Usuarios_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function getById($id){

        $grupo = new Group();
        $pst = Connection::getPreparedStatement('SELECT * FROM grupos WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Grupo');
        $grupo = $pst->fetch();
        return $grupo;
    }

    public function create(Grupo $grupo){

        $sql = 'insert into grupos (nome, descricao, Usuarios_id) values (?, ?, ?)';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $grupo->getNome());
        $pst->bindValue(2, $grupo->getDescricao());
        $pst->bindValue(3, $grupo->getUsuario_id());

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function delete($id){

        $sql = 'delete from grupos where id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function update(Group $grupo){

        $sql = 'update grupos set nome = ?, descricao = ? where id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $grupo->getNome());
        $pst->bindValue(2, $grupo->getDescricao());
        $pst->bindValue(3, $grupo->getIdgroup());     

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function isEmpty(){
        $pst = Connection::getPreparedStatement('select * from grupos');
        $pst->execute();
        
        if($pst->rowCount() < 1){
            return true;
        }else{
            return false;
        }

    }


}