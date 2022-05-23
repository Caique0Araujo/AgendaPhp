<?php

class DaoEventos {

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from eventos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function listarPorUsuario($id){
        $lista = [];
        $sql = 'select * from eventos where Usuarios_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPorId($id){

        $evento = new Evento();
        $pst = Conexao::getPreparedStatement('SELECT * FROM eventos WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Evento');
        $evento = $pst->fetch();
        return $evento;
    }

    public function inclui(Evento $evento){

        $sql = 'insert into eventos (nome, data, descricao, Usuarios_id) values (?, ?, ?, ?)';

        $descricao = null;
        if($evento->getDescricao() != null){
            $descricao = $evento->getDescricao();
        }

        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $evento->getNome());
        $pst->bindValue(2, $evento->getData());
        $pst->bindValue(3, $descricao);
        $pst->bindValue(4, $evento->getUsuario_id());

        if($pst->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function excluir($id){

        $sql = 'delete from eventos where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function atualizar(Evento $evento){

        $sql = 'update eventos set nome = ?, data = ?, descricao = ? where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $evento->getNome());
        $pst->bindValue(2, $evento->getData());  
        $pst->bindValue(3, $evento->getDescricao());
        $pst->bindValue(4, $evento->getId());

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function vazio(){
        $pst = Conexao::getPreparedStatement('select * from eventos');
        $pst->execute();
        
        if($pst->rowCount() < 1){
            return true;
        }else{
            return false;
        }

    }

}