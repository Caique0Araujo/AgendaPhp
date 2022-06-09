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
    public function renderLogin()
    {
        $view = new UserView();
        $view->login();
    }

    public function renderRegister()
    {
        $view = new UserView();
        $view->addForm();
    }

    public function login($data)
    {
        if(!empty($data['login'])){
            $login = $data['login'];
        }
        if(!empty($data['email'])){
            $login = $data['email'];
        }

        if(!isset($login)){
            echo 'Insira login ou email!';
            return false;
        }

        if(empty($data['password'])){
            echo 'Insira senha!';
            return false;
        }

        $password = $data['password'];

        $dao = new DaoUser();

        if(!$dao->authLogin($login, $password)){
            echo 'Credenciais inválidas!';
            return false;
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

        $verify = new Verify();

        

        $confirmPassword = $data['confirmPassword'];

        if($confirmPassword != $password){
            echo 'Senhas diferentes, tente novament!';
            return;
        }

        if($verify->emailActive($email)){
            echo 'Email já cadastrado';
            return;
        }
        if($verify->loginActive($login)){
            echo 'Login já cadastrado';
            return;
        }


        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setFone($fone);
        $user->setLogin($login);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $dao = new DaoUser();
        $view = new UserView();



        if($verify->emailDesactive($email) || $verify->loginDesactive($login)){
            $id = $dao->getIdByLogin($login, $email);
            $user->setId($id);
            $dao->update($user);
            return $view->login();
            
        }

        $dao->create($user);
        
        return $view->login();

    }

    public function update()
    {
        $view = new UserView();
        $dao = new DaoUser();
        $user = $dao->getById($_SESSION['id']);
        $view->editForm($user);
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
