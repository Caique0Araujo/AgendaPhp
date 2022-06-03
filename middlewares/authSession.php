<?php


namespace Agenda\Middlewares;

use Agenda\Dao\DaoUser;

session_start();


class AuthSession
{
    public function __construct()
    {
    }

    public function verifyUser()
    {
        $dao = new DaoUser();
        $id = $_SESSION['id'];
        $user =  $dao->getById($id);
        if (!isset($user)) {
            header('Location: /agendaPhp/login');
            exit;
        }
    }
    public function verifySession()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /agendaPhp/login');
            exit;
        }
    }
}
