<?php


namespace Agenda\Views;

class HomeView
{
    public function __construct()
    {
        
    }
    public function render()
    {
        $title = 'Home';
        $content = file_get_contents('./views/Home/home.html');
        require_once './Views/templates/main.phtml';

    }
}