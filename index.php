<?php
require __DIR__.'/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors',TRUE);
ini_set('error_log','log/php_error.log');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Bramus\Router\Router();

//$router->setNamespace('\App\Ecommerce\Controllers');
$routerDashboard = "\App\Ecommerce\Controllers\Dashboard";
$router->get("/", $routerDashboard."\ProductoController@index");
$router->get("/producto/create", $routerDashboard."\ProductoController@create");
$router->post("/producto/store", $routerDashboard."\ProductoController@store");
$router->get("/producto/edit/{id}", $routerDashboard."\ProductoController@edit");
$router->post("/producto/update/{id}", $routerDashboard."\ProductoController@update");
$router->post("/producto/delete/{id}", $routerDashboard."\ProductoController@delete");


$routerTienda = "\App\Ecommerce\Controllers";
$router->get("/register", $routerTienda."\ClienteController@create");
$router->post("/register/store", $routerTienda."\ClienteController@store");

$router->set404('ErrorController@notFound');
$router->run();


?>