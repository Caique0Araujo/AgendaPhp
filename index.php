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


// MAIN ROUTES

$app->any('/agendaPhp/home', function (Request $request, Response $response,) {
    $controller = new HomeView();
    $controller->render();
    return $response;
});

// CONTACT ROUTES


$app->any('/agendaPhp/contacts', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->indexAll();
    return $response;
});

$app->get('/agendaPhp/addContact', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->store();
    return $response;
});

$app->post('/agendaPhp/addContact', function(Request $request, Response $response){
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $controller = new ControllerContact();
    $controller->storeSave($name, $fone, $email);
});

$app->any('/agendaPhp/editContact', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->update();
    return $response;
});

// EVENTS ROUTES

$app->any('/agendaPhp/events', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->indexAll();
    return $response;
});

$app->any('/agendaPhp/addEvent', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->store();
    return $response;
});

$app->any('/agendaPhp/editEvent', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->update();
    return $response;
});

// GROUPS ROUTES

$app->any('/agendaPhp/groups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->indexAll();
    return $response;
});

$app->any('/agendaPhp/addGroups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->store();
    return $response;
});

$app->any('/agendaPhp/editGroups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->update();
    return $response;
});


$app->run();
