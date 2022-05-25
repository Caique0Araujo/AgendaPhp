<?php

namespace Agenda\Dao;

use PDO;
use Agenda\Dao\Connection;

class DaoContatoEvento {

    public function getAll(){

        $lista = [];
        $pst = Connection::getPreparedStatement('select * from eventos_has_contatos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function create(ContatoEvento $contatoEvento){

        $sql = 'insert into eventos_has_contatos (Eventos_id, Contatos_id) values (?, ?);';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $contatoEvento->getEventos_id());
        $pst->bindValue(2, $contatoEvento->getContatos_id());
        

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function deleteByContact($id){

        $sql = 'delete from eventos_has_contatos where Contatos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteByEvent($id){

        $sql = 'delete from eventos_has_contatos where Eventos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function isEmpty(){

        $pst = Connection::getPreparedStatement('select * from eventos_has_contatos');
        $pst->execute();
        if($pst->rowCount() > 0){
            return false;
        }
        else{
            return true;
        } 

    }

    public function delete($idcon, $idevento){

        $sql = 'delete from eventos_has_contatos where Contatos_id = ? and Eventos_id = ?';
        $pst = Connection::getPreparedStatement($sql);

        $pst->bindValue(1, $idcon);
        $pst->bindValue(2, $idevento);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

}