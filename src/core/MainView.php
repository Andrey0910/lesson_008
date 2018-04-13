<?php

namespace App\Core;


class MainView
{
    public function render($nameView, $data = null)
    {
        $template = TEMPLATE_DIR.DIRECTORY_SEPARATOR.$nameView.'.php';
        if (!file_exists($template)){
            throw new NotFound('Файл '.$nameView.' не найден.');
        }
        if (!empty($data)){
            extract($data);
        }
        require $template;
    }
}