<?php

namespace bng\Controllers;

abstract class BaseController
{
    public function view($view, $data = [])
    {
        // check if data is array
        if(!is_array($data)){
            die("Data is not an array: " . var_dump($data));
        }

        // transforms data into variables
        extract($data);

        // caminho absoluto baseado no diretório deste arquivo (app/controllers)
        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            die("View não encontrada: " . $file);
        }
    }
}