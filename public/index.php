<?php

session_start();

use bng\System\Router;

// base relativa (ex: '/FogoBaixo/public' ou '/' se estiver no root)
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base = $scriptDir === '/' ? '' : $scriptDir;
define('BASE_URL', $base);

require_once('../vendor/autoload.php');

Router::dispatch();

