<?php


namespace Agenda\Views;

class HomeView
{
    public function __construct()
    {
        
    }
    public function render($contacts)
    {
        $title = 'Início';
        require_once './views/Home/home.phtml';

    }
}