<?php

namespace App\Core;

class Bootstrap
{
    public function run()
    {
        $router = explode('/', $_SERVER['REQUEST_URI']);
        $controllerName = 'book';
        $actionName = 'getFunctions';
        //Получаем контроллеп
        if (!empty($router[1])) {
            $controllerName = $router[1];
        }
        //Получаем действие
        if (!empty($router[2])) {
            $explode = explode('?', $router[2]);
            $actionName = $explode[0];
        }
        $className = sprintf('\\App\\Controllers\\%sController', ucfirst(strtolower($controllerName)));
        if (!class_exists($className)) {
            throw new NotFound('Клаыы ' . $className . ' не найден.');
        }
        $controller = new $className;
        if (!method_exists($controller, $actionName)) {
            throw new NotFound('Метод ' . $actionName . ' не найден в классу ' . $className);
        }
        $controller->$actionName(strtolower($className));
    }
}