<?php
if (file_exists('../.env')) {
    header('Location: ../public/');
    exit;
}
require '../system/bootstrap.php';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$router = service('router');
$router->setDefaultNamespace('App\Controllers');
$router->setDefaultController('InstallController');
$router->handle($uri);