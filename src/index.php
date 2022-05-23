<?php

namespace Agenda;

use Agenda\Controllers\ControllerContact;
use Slim\Factory\AppFactory;

define('_BASE', $_SERVER['DOCUMENT_ROOT'] . '/agenda/');

require_once '../vendor/autoload.php';


$app = AppFactory::create();


$app->any('/agenda/src/home', function($req, $res){
    $controller = new ControllerContact();
    $controller->showAll();
    $res->getBody()->write('Oh shit');
    return $res;
});

$app->run();



