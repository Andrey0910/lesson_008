<?php

namespace App\Core;

use App\Controllers\BookController;
use App\Controllers\SectionBooksController;

class Bootstrap
{
    public function run()
    {
        $actionName = str_replace('/api/v1', '', $_SERVER['REQUEST_URI']);
        $actionName = explode('?', $actionName);
        $typeObject = $actionName[0];
        $requestmethod = $_SERVER['REQUEST_METHOD'];
        if ($typeObject == '/books') {
            $controller = new BookController();
            switch ($requestmethod) {
                case 'GET':
                    $controller->index();
                    break;
                case 'POST':
                    $controller->update();
                    break;
                case 'DELETE':
                    $controller->delete();
                    break;
                case "PUT":
                case "PATCH":
                    $controller->add();
            }
        } elseif ($typeObject == '/section-books') {
            $controller = new SectionBooksController();
            switch ($requestmethod) {
                case 'GET':
                    $controller->index();
                    break;
                case 'POST':
                    $controller->update();
                    break;
                case 'DELETE':
                    $controller->delete();
                    break;
                case "PUT":
                case "PATCH":
                    $controller->add();
            }
        }
    }
}