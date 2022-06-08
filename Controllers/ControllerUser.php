<?php

namespace Agenda\Controllers;

use Agenda\Models\User;
use Agenda\Views\Users\UserView;
use Agenda\Dao\DaoUser;
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

        $confirmPassword = $data['confirmPassword'];

        if($confirmPassword != $password){
            echo 'Senhas diferentes, tente novament!';
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setFone($fone);
        $user->setLogin($login);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));

        $dao = new DaoUser();
        $dao->create($user);
        
        $view = new UserView();
        $view->render();

    }

    public function update()
    {
        $view = new UserView();
        $view->editForm();
    }
    public function delete()
    {
    }

    public function logout(){
        session_start();
        unset($_SESSION['id']);
    }
}
