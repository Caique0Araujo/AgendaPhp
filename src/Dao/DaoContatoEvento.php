<?php

class DaoContatoEvento {

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from eventos_has_contatos');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function inclui(ContatoEvento $contatoEvento){

        $sql = 'insert into eventos_has_contatos (Eventos_id, Contatos_id) values (?, ?);';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $contatoEvento->getEventos_id());
        $pst->bindValue(2, $contatoEvento->getContatos_id());
        

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function excluirPorContato($id){

        $sql = 'delete from eventos_has_contatos where Contatos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function excluirPorEvento($id){

        $sql = 'delete from eventos_has_contatos where Eventos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $id);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function listaVazia(){

        $pst = Conexao::getPreparedStatement('select * from eventos_has_contatos');
        $pst->execute();
        if($pst->rowCount() > 0){
            return false;
        }
        else{
            return true;
        } 

    }

    public function excluir($idcon, $idevento){

        $sql = 'delete from eventos_has_contatos where Contatos_id = ? and Eventos_id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $idcon);
        $pst->bindValue(2, $idevento);
        if($pst->execute()){
            return true;
        }else{
            return false;
        }
    }

}