<?php


require '../vendor/autoload.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
$router = new League\Route\Router;

require '../routes/web.php';

$response = $router->dispatch($request);
