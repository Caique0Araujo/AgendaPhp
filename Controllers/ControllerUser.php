<?php

namespace Agenda\Controllers;

use Agenda\Models\User;
use Agenda\Views\Users\UserView;
use Agenda\Dao\DaoUser;

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
}
