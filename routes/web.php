<?php


$router->get('/news', 'App\Http\Controllers\NewsController::index');
$router->get('/news/{id}', 'App\Http\Controllers\NewsController::show');
$router->post('/news/store', 'App\Http\Controllers\NewsController::store');
$router->get('/', 'App\Http\Controllers\HomeController::index');
$router->get('/bonjour', 'App\Http\Controllers\HomeController::bonjour');
