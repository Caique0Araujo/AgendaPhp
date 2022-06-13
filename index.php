<?php

namespace Agenda;


use Agenda\Controllers\ControllerContact;
use Agenda\Controllers\ControllerContactEvent;
use Agenda\Controllers\ControllerContactGroup;
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
    $controller = new ControllerContact();
    $controller->indexHome();
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
    $controller->renderLogin('Faça o login para continuar');
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

$app->any('/agendaPhp/editUserc', function (Request $request, Response $response,) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $_POST['login'];

    $controller = new ControllerUser();
    $controller->updateSave($id, $name, $login, $fone, $email);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/contacts')->withStatus(302);

})
->add($auth);

$app->any('/agendaPhp/deleteUser', function (Request $request, Response $response, $args) {
    $controller = new ControllerUser();
    $controller->delete($_SESSION['id']);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/logout')->withStatus(302);

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


$app->get('/agendaPhp/addGroup', function (Request $request, Response $response,) {

    $controller = new ControllerGroup();
    $controller->store();
    return $response;
})
->add($auth);


$app->post('/agendaPhp/addGroup', function (Request $request, Response $response,) {
   
    $name = $_POST['name'];
    $description = $_POST['description'];
    $controller = new ControllerGroup();
    $controller->storeSave($name, $description);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/groups')->withStatus(302);

})
->add($auth);


$app->get('/agendaPhp/editGroup/{id}', function (Request $request, Response $response, $id) {

    $controller = new ControllerGroup();
    $controller->update($id['id']);
    return $response;
})
->add($auth);

$app->any('/agendaPhp/editGroup', function (Request $request, Response $response,) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $controller = new ControllerGroup();
    $controller->updateSave($id, $name, $description);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/groups')->withStatus(302);

})
->add($auth);

$app->any('/agendaPhp/deleteGroup', function (Request $request, Response $response,) {
   
    $id = $_POST['id'];
    $controller = new ControllerGroup();
    $controller->delete($id);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/groups')->withStatus(302);
})
->add($auth);


// ContactEvents

$app->get('/agendaPhp/addContactEvent/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerContactEvent();
    $id = $id['id'];
    $controller->store($id);
    return $response;
})
->add($auth);

$app->any('/agendaPhp/addContactEvent', function (Request $request, Response $response) {
    $eventId = $_POST['eventId'];
    $contacts = $_POST['contacts']; 
    $controller = new ControllerContactEvent();
    $controller->storeSave($eventId, $contacts);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/events')->withStatus(302);

})
->add($auth);

$app->get('/agendaPhp/removeContactEvent/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerContactEvent();
    $id = $id['id'];
    $controller->update($id);
    return $response;
})
->add($auth);

$app->any('/agendaPhp/removeContactEvent', function (Request $request, Response $response) {
    $contacts = $_POST['contacts'];
    $event = $_POST['idEvent'];
    $controller = new ControllerContactEvent();
    $controller->updateSave($event, $contacts);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/events')->withStatus(302);

})
->add($auth);


// ContactGroups

$app->get('/agendaPhp/addContactGroup/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerContactGroup();
    $id = $id['id'];
    $controller->store($id);
    return $response;
})
->add($auth);

$app->any('/agendaPhp/addContactGroup', function (Request $request, Response $response) {
    $groupId = $_POST['groupId'];
    $contacts = $_POST['contacts']; 
    $controller = new ControllerContactGroup();
    $controller->storeSave($groupId, $contacts);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/groups')->withStatus(302);

})
->add($auth);

$app->get('/agendaPhp/removeContactGroup/{id}', function (Request $request, Response $response, $id) {
    $controller = new ControllerContactGroup();
    $id = $id['id'];
    $controller->update($id);
    return $response;
})
->add($auth);

$app->any('/agendaPhp/removeContactGroup', function (Request $request, Response $response) {
    $contacts = $_POST['contacts'];
    $group = $_POST['idGroup'];
    $controller = new ControllerContactGroup();
    $controller->updateSave($group, $contacts);
    return $response->withHeader('Location', 'http://localhost/agendaPhp/groups')->withStatus(302);

})
->add($auth);

$app->run();
