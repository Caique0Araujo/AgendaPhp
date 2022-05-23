<?php

namespace Agenda\Controllers;

 use Agenda\Views\ContactView;


class ControllerContact
{   
    public function __construct()
    {
        
    }

    public function showAll(){
        $view = new ContactView();
        $view->render();
    }


}
