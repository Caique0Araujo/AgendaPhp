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

$auth = function ($request, $handler) {
    $auth = new AuthSession();
    $auth->verifySession();
    $auth->verifyUser();
    return $handler->handle($request);
};


// MAIN ROUTES

$app->get('/agendaPhp/home', function (Request $request, Response $response) {
    $controller = new HomeView();
    $controller->render();
    return $response;
})
->add($auth);

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
    return $response->withHeader('Location', 'http://localhost/agendaPhp/login')->withStatus(302);
});

$app->get('/agendaPhp/login', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $controller->renderLogin();
    return $response;
});

$app->post('/agendaPhp/login', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $data = $request->getParsedBody();

    if($controller->login($data)){
        return $response->withHeader('Location', 'http://localhost/agendaPhp/home')->withStatus(302);
    }
    return $response->withHeader('Location', 'http://localhost/agendaPhp/login')->withStatus(302);
});

$app->get('/agendaPhp/logout', function (Request $request, Response $response){
    $controller = new ControllerUser();
    $controller->logout();
    return $response->withHeader('Location', 'http://localhost/agendaPhp/login')->withStatus(302);
});

$app->get('/agendaPhp/editUser', function (Request $request, Response $response) {
    $controller = new ControllerUser();
    $controller->update();
    return $response;
})
->add($auth);





// CONTACT ROUTES


$app->get('/agendaPhp/contacts', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->indexAll();
    return $response;
})
->add($auth);

$app->get('/agendaPhp/addContact', function (Request $request, Response $response,) {
    $controller = new ControllerContact();
    $controller->store();
    return $response;
})
->add($auth);

$app->post('/agendaPhp/addContact', function (Request $request, Response $response) {
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $controller = new ControllerContact();
    $controller->storeSave($name, $fone, $email);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/contacts')->withStatus(302);
    

})
->add($auth);

$app->get('/agendaPhp/editContact/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerContact();
    $controller->update($id['id']);
    return $response;
})
->add($auth);


$app->any('/agendaPhp/editContact', function (Request $request, Response $response,) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];

    $controller = new ControllerContact();
    $controller->updateSave($id, $name, $fone, $email);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/contacts')->withStatus(302);

})
->add($auth);


$app->any('/agendaPhp/deleteContact', function (Request $request, Response $response, $args) {
    $id = $_POST['id'];
    $controller = new ControllerContact();
    $controller->delete($id);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/contacts')->withStatus(302);

})
->add($auth);



// EVENTS ROUTES

$app->any('/agendaPhp/events', function (Request $request, Response $response,) {
    $controller = new ControllerEvent();
    $controller->indexAll();
    return $response;
})
->add($auth);


$app->get('/agendaPhp/addEvent', function (Request $request, Response $response,) {

    $controller = new ControllerEvent();
    $controller->store();
    return $response;
})
->add($auth);

$app->post('/agendaPhp/addEvent', function (Request $request, Response $response,) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $controller = new ControllerEvent();
    $controller->storeSave($name, $description, $date);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/events')->withStatus(302);

})
->add($auth);


$app->get('/agendaPhp/editEvent/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerEvent();
    $controller->update($id['id']);
    return $response;
})
->add($auth);


$app->any('/agendaPhp/editEvent', function (Request $request, Response $response,) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $controller = new ControllerEvent();
    $controller->updateSave($id, $name, $description, $date);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/events')->withStatus(302);


})
->add($auth);


$app->any('/agendaPhp/deleteEvent', function (Request $request, Response $response,) {
    $id = $_POST['id'];
    $controller = new ControllerEvent();
    $controller->delete($id);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/events')->withStatus(302);
})
->add($auth);


// GROUPS ROUTES

$app->any('/agendaPhp/groups', function (Request $request, Response $response,) {
    $controller = new ControllerGroup();
    $controller->indexAll();
    return $response;
})
->add($auth);


$app->get('/agendaPhp/addGroups', function (Request $request, Response $response,) {


    $controller = new ControllerGroup();
    $controller->store();
    return $response;
})
->add($auth);


$app->post('/agendaPhp/addGroups', function (Request $request, Response $response,) {
})
->add($auth);


$app->get('/agendaPhp/editGroups', function (Request $request, Response $response,) {
})
->add($auth);

$app->put('/agendaPhp/editGroups', function (Request $request, Response $response,) {
})
->add($auth);

$app->delete('/agendaPhp/deleteGroups', function (Request $request, Response $response,) {
})
->add($auth);


// ContactEvents

$app->get('/agendaPhp/addContactEvent', function (Request $request, Response $response,) {
})
->add($auth);

$app->get('/agendaPhp/removeContactEvent', function (Request $request, Response $response,) {
})
->add($auth);


// ContactGroups

$app->get('/agendaPhp/addContactGroup', function (Request $request, Response $response,) {
})
->add($auth);

$app->get('/agendaPhp/removeContactGroup', function (Request $request, Response $response,) {
})
->add($auth);


$app->run();
