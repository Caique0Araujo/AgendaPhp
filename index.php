<?php

namespace Agenda;

use Slim\Factory\AppFactory;

define('_BASE', $_SERVER['DOCUMENT_ROOT'] . '/agenda/');

require_once './vendor/autoload.php';

$app = AppFactory::create();


$app->any('/agenda/home', function($req, $res){
    $res->getBody()->write('Oh shit');
    return $res;
});

$app->run();



