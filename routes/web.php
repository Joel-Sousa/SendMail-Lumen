<?php

use App\Http\Controllers\DataController;

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
    // return $router->app->version();
    return view('index');
});

$router->group(['prefix' => '/'], function() use ($router){

    $router->post('/send-mail', 'DataController@sendMail');
    $router->post('/clean-log', 'DataController@cleanLog');

});

$router->get('/hello', function () {
    return 'Lumen funcionando!';
});
