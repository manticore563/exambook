<?php
// Check if already installed
if (file_exists('../.env')) {
    header('Location: ../public/');
    exit;
}

// Bootstrap CodeIgniter
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require_once '../system/bootstrap.php';

// Manual routing for installer
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$uri = str_replace('/exambook/install', '', $uri) ?: '/';
$router = service('router');
$router->setDefaultNamespace('App\Controllers');
$router->setDefaultController('InstallController');
$router->setDefaultMethod('index');
$router->handle($uri);