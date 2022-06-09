<?php

namespace Agenda\Helpers;

use Agenda\Dao\DaoUser;

class Verify {


    public  function emailActive($email){
        $dao = new DaoUser();
        if($dao->getByEmail($email, 1)){
            return true;
        }
        return false;


    }

    public  function loginActive($login){
        $dao = new DaoUser();
        if($dao->getByLogin($login, 1)){
            return true;
        }
        return false;
        
    }
    public  function emailDesactive($email){
        $dao = new DaoUser();
        if($dao->getByEmail($email, 0)){
            return true;
        }
        return false;


    }

    public  function loginDesactive($login){
        $dao = new DaoUser();
        if($dao->getByLogin($login, 0)){
            return true;
        }
        return false;
        
    }
}


?>