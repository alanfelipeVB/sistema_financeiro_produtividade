<?php

class Controller
{
    protected function view($viewName, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../app/Views/{$viewName}.php";
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit();
    }
}

