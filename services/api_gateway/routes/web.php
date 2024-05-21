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

use App\Http\Controllers\UserController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('foo', function () {
    return 'Hello World';
});

$router->group(['prefix' => 'api', /*'namespace' => 'App\Http\Controllers'*//*'middleware' => ['client.credentials']*/], function () use ($router) {
    $router->group(['prefix' => 'user'], function () use ($router) {
      /*  $router->get('/', function () {
            return 'Hello World';
        });*/
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('/{userId}', ['uses' => 'UserController@store']);
    });

    $router->group(['prefix' => 'messenger'], function () use ($router) {
/*        $router->get('/', ['uses' => 'UserController@index']);
        $router->post('/{userId}', ['uses' => 'UserController@store']);*/
    });
});
