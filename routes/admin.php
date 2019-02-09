<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| you can register all of the routes for Admin scope
*/
$router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function () use ($router) {
    // Users
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@getAll');
        $router->get('/{id}', 'UserController@getDetails');
        $router->post('/', 'UserController@create');
    });
});
