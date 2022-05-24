<?php

class DaoContato {

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from contatos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function listarPorUsuario($id){
        $lista = [];
        $sql = 'select * from contatos where Usuarios_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPorGrupo($id){
        $lista = [];
        $pst = Conexao::getPreparedStatement('SELECT * FROM contatos AS c INNER JOIN grupos_has_contatos AS gc ON c.id = gc.Contatos_id WHERE Grupos_id = '.$id.';');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPorEvento($id){
        $lista = [];
        $pst = Conexao::getPreparedStatement('SELECT * FROM contatos AS c INNER JOIN eventos_has_contatos AS ec ON c.id = ec.Contatos_id WHERE Eventos_id = '.$id.';');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function listarPorId($id){

        $contato = new Contato();
        $pst = Conexao::getPreparedStatement('SELECT * FROM contatos WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Contato');
        $contato = $pst->fetch();
        return $contato;
    }

    public function inclui(Contato $contato){

        $sql = 'insert into contatos(nome, fone, email, Usuarios_id) values (?, ?, ?, ?)';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $contato->getNome());
        $pst->bindValue(2, $contato->getFone());
        $pst->bindValue(3, $contato->getEmail());
        $pst->bindValue(4, $contato->getUsuario_id());

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function excluir($id){

        $sql = 'delete from contatos where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function atualizar(Contato $c){

        $sql = 'update contatos set nome = ?, fone = ?, email = ? where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $c->getNome());
        $pst->bindValue(2, $c->getFone());
        $pst->bindValue(3, $c->getEmail());
        $pst->bindValue(4, $c->getIdcon());

        if($pst->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function vazio(){
        $pst = Conexao::getPreparedStatement('select * from contatos');
        $pst->execute();
        
        if($pst->rowCount() < 1){
            return true;
        }else{
            return false;
        }

    }

}