<?php

namespace App\Controllers;

use App\Core\MainView as View;

class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}