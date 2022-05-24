<?php

namespace Agenda;

use Agenda\Controllers\ControllerContact;
use Agenda\Controllers\ControllerEvent;
use Agenda\Controllers\ControllerGroup;
use Agenda\Views\HomeView;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

define('_BASE', $_SERVER['DOCUMENT_ROOT'] . '/agendaPhp/');

require_once './vendor/autoload.php';


$app = AppFactory::create();


$app->any('/agendaPhp/home', function (Request $request, Response $response,) {
    $controller = new HomeView();
    $controller->render();
    return $response;
});


$app->any('/agendaPhp/contacts', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->indexAll();
    return $response;
});

$app->any('/agendaPhp/events', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->indexAll();
    return $response;
});

$app->any('/agendaPhp/groups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->indexAll();
    return $response;
});

$app->run();
