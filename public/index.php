<?php

use m2i\framework\Router;
use m2i\framework\Dispatcher;

// point vers le dossier parent
define("ROOT_PATH", dirname(__DIR__));

require ROOT_PATH . "/vendor/autoload.php";

$route = filter_input(INPUT_GET, "route", FILTER_SANITIZE_URL);

$router = new Router($route);

$dispatcher = new Dispatcher($router, "m2i\\project\\controllers\\");
$dispatcher->run();
