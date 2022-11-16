<?php
require_once("libs/Router.php");
require_once("app/controllers/showsApiController.php");
require_once("app/controllers/apiAuthController.php");



define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

// recurso solicitado
$resource = $_GET["resource"];

// método utilizado
$method = $_SERVER["REQUEST_METHOD"];

// instancia el router
$router = new Router();

// arma la tabla de ruteo
$router->addRoute("shows", "GET", "ShowsApiController", "getShows");
$router->addRoute("shows", "POST", "ShowsApiController", "addShow");
$router->addRoute("shows/:ID", "GET", "ShowsApiController", "getShow");
$router->addRoute("shows/:ID", "DELETE", "ShowsApiController", "deleteShow");
$router->addRoute("shows/:ID", "PUT", "ShowsApiController", "editShow");
$router->addRoute("auth/token", "GET", "AuthApiController", "getToken");


// rutea
$router->route($resource, $method);