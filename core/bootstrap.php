<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/Model.php';

// Carregar todos os modelos
foreach (glob(__DIR__ . '/../app/Models/*.php') as $filename) {
    require_once $filename;
}

// Carregar todos os controladores
foreach (glob(__DIR__ . '/../app/Controllers/*.php') as $filename) {
    require_once $filename;
}

// Iniciar a conexão com o banco de dados
Database::connect();

