<?php

class DaoContatoGrupo {

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from grupos_has_contatos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function listarPorGrupo($id){
        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from grupos_has_contatos where Grupos_id ='.$id.';');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    public function inclui(ContatoGrupo $contatoGrupo){

        $sql = 'insert into grupos_has_contatos(Contatos_id, Grupos_id) values (?, ?)';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $contatoGrupo->getIdcon());
        $pst->bindValue(2, $contatoGrupo->getIdgroup());
        

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function listaVazia(){

        $pst = Conexao::getPreparedStatement('select * from grupos_has_contatos');
        $pst->execute();
        if($pst->rowCount() > 0){
            return false;
        }
        else{
            return true;
        } 

    }

    public function excluirPorContato($id){

        $sql = 'delete from grupos_has_contatos where Contatos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function excluirPorGrupo($id){

        $sql = 'delete from grupos_has_contatos where Grupos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function excluir($idGrupo, $idContato){

        $sql = 'delete from grupos_has_contatos where Grupos_id = ? and Contatos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $idGrupo);
        $pst->bindValue(2, $idContato);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }
}