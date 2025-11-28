<?php

require_once __DIR__ . '/core/bootstrap.php';
require_once __DIR__ . "/core/Router.php";

$router = new Router();

// Definir rotas
$router->get('/', 'HomeController@index');
$router->get("/login", "AuthController@showLoginForm");
$router->get("/register", "RegisterController@showRegistrationForm");
$router->post("/register", "RegisterController@register");
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/dashboard', 'DashboardController@index');
$router->get('/transactions', 'TransactionController@index');
$router->get('/transactions/create', 'TransactionController@create');
$router->post('/transactions', 'TransactionController@store');
$router->get("/accounts", "AccountController@index");
$router->get("/accounts/create", "AccountController@create");
$router->post("/accounts", "AccountController@store");
$router->get("/categories", "CategoryController@index");
$router->get("/categories/create", "CategoryController@create");
$router->post("/categories", "CategoryController@store");
// Adicione mais rotas conforme necessário

$router->dispatch();

