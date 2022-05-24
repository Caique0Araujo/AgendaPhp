<?php

namespace Agenda\Views\Contacts;

class ContactView
{
    public function __construct()
    {
    }
    public function render()
    {
        $title = 'Contact';
        require_once './Views/templates/main.phtml';
    }
}
