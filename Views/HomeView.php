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
        $content = '';
        require_once './Views/templates/main.phtml';

    }
}