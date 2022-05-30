<?php

namespace Agenda;

use Agenda\Controllers\ControllerContact;
use Agenda\Controllers\ControllerEvent;
use Agenda\Controllers\ControllerGroup;
use Agenda\Controllers\ControllerUser;
use Agenda\Middlewares\AuthSession;
use Agenda\Views\HomeView;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

define('_BASE', $_SERVER['DOCUMENT_ROOT'] . '/agendaPhp/');

require_once './vendor/autoload.php';


$app = AppFactory::create();

$auth = function ($request, $response) {
    $auth = new AuthSession();
    $auth->verifySession();
    $auth->verifyUser();
    return $response;
};


// MAIN ROUTES

$app->any('/agendaPhp/home', function (Request $request, Response $response) {
    $controller = new HomeView();
    $controller->render();
    return $response;
});
//->add($auth);

// USERS ROUTES

$app->get('/agendaPhp/register', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $controller->renderRegister();
    return $response;
});

$app->post('/agendaPhp/register', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $data = $request->getParsedBody();
    $controller->register($data);
    return $response;
});

$app->get('/agendaPhp/login', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $controller->renderLogin();
    return $response;
});

$app->post('/agendaPhp/login', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $data = $request->getParsedBody();

    $controller->login($data);
    return $response;
});




// CONTACT ROUTES


$app->any('/agendaPhp/contacts', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->indexAll();
    return $response;
});
//->add($auth);

$app->get('/agendaPhp/addContact', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->store();
    return $response;
});

$app->post('/agendaPhp/addContact', function (Request $request, Response $response) {
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $controller = new ControllerContact();
    $controller->storeSave($name, $fone, $email);
});

$app->get('/agendaPhp/editContact/{id}', function (Request $request, Response $response, $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    $controller = new ControllerContact();
    $controller->update($id);
    return $response;
});

$app->put('/agendaPhp/editContact', function (Request $request, Response $response,) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $controller = new ControllerContact();
    $controller->updateSave($id, $name, $fone, $email);
    return $response;
});

$app->delete('/agendaPhp/deleteContact/{id}', function (Request $request, Response $response, $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    $controller = new ControllerContact();
    $controller->delete($id);
    return $response;
});


// EVENTS ROUTES

$app->any('/agendaPhp/events', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->indexAll();
    return $response;
});

$app->get('/agendaPhp/addEvent', function (Request $request, Response $response,) {

    $controller = new ControllerEvent();
    $controller->store();
    return $response;
});

$app->post('/agendaPhp/addEvent', function (Request $request, Response $response,) {
});

$app->get('/agendaPhp/editEvent/{id}', function (Request $request, Response $response, $args) {
});

$app->put('/agendaPhp/editEvent', function (Request $request, Response $response,) {
});

$app->delete('/agendaPhp/deleteEvent', function (Request $request, Response $response,) {
});

// GROUPS ROUTES

$app->any('/agendaPhp/groups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->indexAll();
    return $response;
});

$app->get('/agendaPhp/addGroups', function (Request $request, Response $response,) {


    $controller = new ControllerGroup();
    $controller->store();
    return $response;
});

$app->post('/agendaPhp/addGroups', function (Request $request, Response $response,) {
});

$app->get('/agendaPhp/editGroups', function (Request $request, Response $response,) {
});

$app->put('/agendaPhp/editGroups', function (Request $request, Response $response,) {
});

$app->delete('/agendaPhp/deleteGroups', function (Request $request, Response $response,) {
});

// ContactEvents

$app->get('/agendaPhp/addContactEvent', function (Request $request, Response $response,) {
});

$app->get('/agendaPhp/removeContactEvent', function (Request $request, Response $response,) {
});


// ContactGroups

$app->get('/agendaPhp/addContactGroup', function (Request $request, Response $response,) {
});

$app->get('/agendaPhp/removeContactGroup', function (Request $request, Response $response,) {
});


$app->run();
