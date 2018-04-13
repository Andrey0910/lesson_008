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
        } elseif ($typeObject == '/sectionBooks') {
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


//        $router = explode('/', $_SERVER['REQUEST_URI']);
//        $controllerName = 'book';
//        $actionName = 'requestMethod';
//        //Получаем контроллеп
//        if (!empty($router[1])) {
//            $controllerName = $router[1];
//        }
//        //Получаем действие
//        if (!empty($router[2])) {
//            $explode = explode('?', $router[2]);
//            $actionName = $explode[0];
//        }
//        $className = sprintf('\\App\\Controllers\\%sController', ucfirst(strtolower($controllerName)));
//        if (!class_exists($className)) {
//            throw new NotFound('Клаыы ' . $className . ' не найден.');
//        }
//        $controller = new $className;
//        if (!method_exists($controller, $actionName)) {
//            throw new NotFound('Метод ' . $actionName . ' не найден в классу ' . $className);
//        }
//        $controller->$actionName(strtolower($className));
    }
}