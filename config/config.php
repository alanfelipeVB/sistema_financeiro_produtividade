<?php
require_once __DIR__ . "/env.php";

$env = new Env();
define('BASE_URL', 'teste');
define('DB_HOST', $env->dbHost);
define('DB_USER', $env->dbUser);
define('DB_PASSWORD', $env->dbPswd);
define('DB_NAME', $env->dbName);