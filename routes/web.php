<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Auth

$router->post('login','AuthController@login');
$router->group(['middleware' => 'auth:api'], function () use ($router) {

    // Product    
    $router->get('product','ProductController@index');
    $router->get('product-list','ProductController@list');
    $router->get('product-count','ProductController@count');
    $router->post('product','ProductController@store');
    $router->get('product/{id}','ProductController@show');
    $router->put('product/{id}','ProductController@update');
    $router->delete('product/{id}','ProductController@destroy');
    
});
