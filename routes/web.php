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

// GET /api/v1
$app->group(['prefix' => 'v1', 'middleware' => 'auth'], function () use ($app) {
    $app->get('/', 'ExampleController@version');
});
