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
$router->get('/transactions/edit', 'TransactionController@edit');
$router->get('/transactions/delete', 'TransactionController@delete');
$router->post('/transactions', 'TransactionController@store');
$router->post('/transactions/update', 'TransactionController@update');
$router->get("/accounts", "AccountController@index");
$router->get("/accounts/create", "AccountController@create");
$router->get("/accounts/edit", "AccountController@edit");
$router->get("/accounts/delete", "AccountController@delete");
$router->post("/accounts", "AccountController@store");
$router->post('/accounts/update', 'AccountController@update');
$router->get("/categories", "CategoryController@index");
$router->get("/categories/create", "CategoryController@create");
$router->post("/categories", "CategoryController@store");

$router->dispatch();

