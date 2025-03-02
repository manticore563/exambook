<?php
namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::register');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('admin/create-test', 'AdminController::createTest');
$routes->post('admin/create-test', 'AdminController::createTest');
$routes->get('admin/add-questions/(:num)', 'AdminController::addQuestions/$1');
$routes->post('admin/add-questions/(:num)', 'AdminController::addQuestions/$1');
$routes->get('admin/bulk-upload/(:num)', 'AdminController::bulkUpload/$1');
$routes->post('admin/bulk-upload/(:num)', 'AdminController::bulkUpload/$1');
$routes->get('tests', 'TestController::index');
$routes->get('tests/take/(:num)', 'TestController::takeTest/$1');
$routes->post('tests/submit-answer', 'TestController::submitAnswer');
$routes->get('tests/results/(:num)', 'TestController::results/$1');