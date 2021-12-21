<?php

// Cheat cors for now
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,HEAD,PUT,POST,DELETE,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');
$router->options('/{any:.*}', [function (){ 
   return response(['status' => 'success']); 
  }
 ]
);

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

$router->group([], function () use ($router) {
    $router->get('todos', 'TodoController@getTodos');
    $router->delete('todos', 'TodoController@deleteTodos');

    $router->post('todo', 'TodoController@createTodo');
    $router->get('todo', 'TodoController@getTodo');
    $router->delete('todo/{id}', 'TodoController@deleteTodo');
    $router->patch('todo/{id}', 'TodoController@updateTodo');
});

