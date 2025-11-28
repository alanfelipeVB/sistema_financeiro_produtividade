<?php

require_once __DIR__ . '/../env.php';

function base_url($path = '')
{
    // cria o env AQUI, dentro da função
    $env = new Env();

    return rtrim($env->baseUrl, '/') . '/' . ltrim($path, '/');
}
