<?php

namespace Agenda\Dao;

use PDO;
use PDOException;
use PDOStatement;

class Connection{

    private static $dsn = 'mysql:host=localhost;dbname=id19088349_agenda;port=3306';
    private static $user = 'id19088349_2022tpagendauser';
    private static $password = 'BeeIb[!F*YDn-r9=';
    private static $Connection = null;

    public static function getConnection() : PDO {

        if(Connection::$Connection == null){
            try{
                Connection::$Connection = new PDO (Connection::$dsn, Connection::$user, Connection::$password);

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        return Connection::$Connection;

    }

    public static function getPreparedStatement($sql) : PDOStatement {
        $pst = null;
        if(Connection::getConnection() != null){
            try {
                $pst = Connection::$Connection->prepare(($sql));
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        return $pst;

    }

}