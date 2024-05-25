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

//use App\Http\Controllers\UserController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('foo/{id}', function ($id) {
    return 'Hello World'.$id;
});



$router->group(['prefix' => 'api', /*'middleware' => ['client.credentials']*/], function () use ($router) {
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('{id}', ['uses' => 'UserController@getUser']);
        $router->post('/', ['uses' => 'UserController@store']);
        $router->patch('/{id}', ['uses' => 'UserController@update']);
        $router->delete('/{id}', ['uses' => 'UserController@destroy']);
    });

    $router->group(['prefix' => 'messenger'], function () use ($router) {

    });
});
