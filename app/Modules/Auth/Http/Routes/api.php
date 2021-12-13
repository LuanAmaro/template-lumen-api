<?php

$router->group(['middleware' => 'auth'], function ($router) {
    $router->get('profile', 'AuthController@me');
});

$router->post('auth/login', 'AuthController@login');
