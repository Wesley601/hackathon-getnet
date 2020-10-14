<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/transactions', 'TransactionController@all');
$router->get('/transactions/{id}', 'TransactionController@find');
$router->post('/transactions', 'TransactionController@create');
$router->post('/recurrent-transactions', 'TransactionController@createRecurrent');
$router->put('/transactions/{id}', 'TransactionController@update');
$router->delete('/transactions/{id}', 'TransactionController@delete');

$router->post('/goals', 'GoalController@check');
