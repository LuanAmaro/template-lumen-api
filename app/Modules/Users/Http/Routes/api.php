<?php

$router->get('/users', 'UserController@index');
$router->get('/users/{userId}', 'UserController@show');
$router->post('/users', 'UserController@store');
$router->put('/users/{userId}', 'UserController@update');
$router->delete('/users/{userId}', 'UserController@destroy');
