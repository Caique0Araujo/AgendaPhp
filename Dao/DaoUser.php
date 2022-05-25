<?php 

class DaoUsuarios {


    public function logar($login, $senha){
        
        $pst = Conexao::getPreparedStatement("SELECT id, ativo FROM usuarios where usuarios.login = ? AND usuarios.senha = ?");
        $pst->bindValue(1, $login);
        $pst->bindValue(2, $senha);
        $pst->execute();
        if($pst->rowCount() > 0){
            
            $dado = $pst->fetch();

            if($dado['ativo']){

                session_start();
                $_SESSION['id'] = $dado['id'];
                return true;

            }else{
                return false;
            }

        }else{
            return false;
        }

    }

    public function listaTodos(){

        $lista = [];
        $pst = Conexao::getPreparedStatement('select * from usuarios');
        $pst->execute();
        $lista = $pst->fetchAll(PDO::FETCH_ASSOC);
        return $lista;

    }

    public function listarPorId($id){

        $usuario = new Usuario();
        $pst = Conexao::getPreparedStatement('SELECT usuarios.id, usuarios.nome, usuarios.login, usuarios.senha, usuarios.fone, usuarios.email, usuarios.ativo FROM usuarios WHERE id = ?');

        $pst->bindValue(1, $id);
        $pst->execute();

        $pst->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $usuario = $pst->fetch();
        return $usuario;
    }

    public function validarLogin($login, $senha){

        $sql = 'select * from usuarios where login = ? and senha = ?;';
        $pst = Conexao::getPreparedStatement($sql);
        $pst->bindValue(1, $login);
        $pst->bindValue(2, $senha);

        $pst->execute();

        if($pst->rowCount() < 1)
            return false;
        else 
            return true; 
    }


    public function verificarLogin2($login){

        $sql = 'select * from usuarios where login = ?;';
        $pst = Conexao::getPreparedStatement($sql);
        $pst->bindValue(1, $login);

        $pst->execute();

        if($pst->rowCount() > 0){
            return true;
        }
        else 
            return false; 
    }

    public function getIdByLogin($login){

        $sql = 'select id from usuarios where login = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $login);

        if($pst->execute()){
            $id = $pst->fetch(PDO::FETCH_COLUMN);
            return $id;
        } else {
            return false;
        }

    }

    public function login($id){

        $sql = 'update usuarios set ativo = 1 where id = ?;';

        $pst = Conexao::getPreparedStatement($sql);
        $pst->bindValue(1, $id);

        if($pst->execute()){
            return true;
        } else {
            return false;
        }
    }

   public function usuarioLogadoExiste($id){

        $sql = 'select * from usuarios where id = ?';
        $pst = Conexao::getPreparedStatement($sql);
        $pst->bindValue(1, $id);

        $pst->execute();

        if($pst->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function inclui(Usuario $usuario){

        $sql = 'insert into usuarios (nome, login, senha, fone, email) values (?, ?, ?, ?, ?)';
        $pst = Conexao::getPreparedStatement($sql);

        $email = null;
        if($usuario->getEmail() != null){
            $email = $usuario->getEmail();
        }

        $pst->bindValue(1, $usuario->getNome());
        $pst->bindValue(2, $usuario->getLogin());
        $pst->bindValue(3, $usuario->getSenha());
        $pst->bindValue(4, $usuario->getFone());
        $pst->bindValue(5, $email);

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }


    public function atualizar(Usuario $usuario){

        $sql = 

        'UPDATE usuarios SET usuarios.nome = ?, usuarios.login = ?, usuarios.senha = ?, usuarios.fone = ?, usuarios.email = ?, usuarios.ativo = ? where id = ?';
        $pst = Conexao::getPreparedStatement($sql);

        $pst->bindValue(1, $usuario->getNome());
        $pst->bindValue(2, $usuario->getLogin());
        $pst->bindValue(3, $usuario->getSenha());
        $pst->bindValue(4, $usuario->getFone());
        $pst->bindValue(5, $usuario->getEmail());
        $pst->bindValue(6, 1);
        $pst->bindValue(7, $usuario->getId());

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function excluir($id){

        $sql = 
        '
        DELETE ec.* FROM grupos_has_contatos AS ec INNER JOIN contatos as c ON c.id = ec.Contatos_id where c.Usuarios_id = '.$id.';
        DELETE ec.* FROM eventos_has_contatos AS ec INNER JOIN contatos as c ON c.id = ec.Contatos_id where c.Usuarios_id = '.$id.';
        DELETE FROM contatos where Usuarios_id = '.$id.';
        DELETE FROM frupos where Usuarios_id = '.$id.';
        DELETE FROM eventos where Usuarios_id = '.$id.';
        DELETE FROM usuarios where id = '.$id.';
        ';

        $pst = Conexao::getPreparedStatement($sql);

        if($pst->execute()){
            return true;
        } else {
            return false;
        }

    }

}