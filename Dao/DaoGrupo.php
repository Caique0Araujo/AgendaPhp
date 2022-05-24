<?php

class DaoGrupo {

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from grupos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function listarPorUsuario($id){
        $lista = [];
        $sql = 'select * from grupos where Usuarios_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPorId($id){

        $grupo = new Grupo();
        $pst = Conexao::getPreparedStatement('SELECT * FROM grupos WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Grupo');
        $grupo = $pst->fetch();
        return $grupo;
    }

    public function inclui(Grupo $grupo){

        $sql = 'insert into grupos (nome, descricao, Usuarios_id) values (?, ?, ?)';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $grupo->getNome());
        $pst->bindValue(2, $grupo->getDescricao());
        $pst->bindValue(3, $grupo->getUsuario_id());

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function excluir($id){

        $sql = 'delete from grupos where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function atualizar(Grupo $grupo){

        $sql = 'update grupos set nome = ?, descricao = ? where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $grupo->getNome());
        $pst->bindValue(2, $grupo->getDescricao());
        $pst->bindValue(3, $grupo->getIdgroup());     

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function vazio(){
        $pst = Conexao::getPreparedStatement('select * from grupos');
        $pst->execute();
        
        if($pst->rowCount() < 1){
            return true;
        }else{
            return false;
        }

    }


}