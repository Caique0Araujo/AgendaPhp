<?php

namespace Agenda\Controllers;

use Agenda\Models\User;
use Agenda\Views\Users\UserView;
use Agenda\Dao\DaoUser;
use Agenda\Helpers\Verify;
use Agenda\Views\HomeView;

class ControllerUser
{
    public function __construct()
    {
    }
    public function indexAll()
    {
        $view = new UserView();
    }

    public function indexOne()
    {
    }
    public function renderLogin($message)
    {
        $view = new UserView();
        $view->login($message);
    }

    public function renderRegister()
    {
        $view = new UserView();
        $view->addForm(null);
    }

    public function login($data)
    {
        $view = new UserView();

        $message = null;

        if(!empty($data['login'])){
            $login = $data['login'];
        }
        if(!empty($data['email'])){
            $login = $data['email'];
        }

        if(!isset($login)){
            $message = 'Insira login ou email!';
            return $view->login($message);
        }

        if(empty($data['password'])){
            $message = 'Insira senha!';
            return $view->login($message);
            
        }

        $password = $data['password'];

        $dao = new DaoUser();

        if(!$dao->authLogin($login, $password)){
            $message = 'Credenciais inválidas!';
            return $view->login($message);
        }

        if($dao->login($login)){
            return true;
        }



    }

    public function register($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $fone = $data['fone'];
        $password = $data['password'];
        $login = $data['login'];
        $message = null;

        $verify = new Verify();
        $view = new UserView();

        

        $confirmPassword = $data['confirmPassword'];

        if($confirmPassword != $password){
            $message = 'Senhas diferentes, tente novamente!';
            return $view->addForm($message);

        }

        if($verify->emailActive($email)){
            $message = 'Email já cadastrado';
            return $view->login($message);

        }
        if($verify->loginActive($login)){
            $message = 'Login já cadastrado';
            return $view->login($message);
            
        }


        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setFone($fone);
        $user->setLogin($login);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $dao = new DaoUser();



        if($verify->emailDesactive($email) || $verify->loginDesactive($login)){
            $id = $dao->getIdByLogin($login, $email);
            $user->setId($id);
            $dao->update($user);
            return $view->login(null);
            
        }

        $dao->create($user);
        
        return $view->login($message);

    }

    public function update()
    {
        $view = new UserView();
        $dao = new DaoUser();
        $user = $dao->getById($_SESSION['id']);
        $view->editForm($user);
    }

    public function updateSave($id, $name, $login, $fone, $email){
        $user = new User();

        $user->setId($id);
        $user->setName($name);
        $user->setEmail($fone);
        $user->setFone($fone);

        $dao = new DaoUser();
        $dao->update($user);
    }

    public function delete($id)
    {
        $dao = new DaoUser();
        $dao->delete($id);
    }

    public function logout(){
        session_start();
        unset($_SESSION['id']);
    }
}
