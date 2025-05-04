<?php

use Numa\Tasks\Route;
use Numa\Tasks\Tasks\TaskController;

include '../vendor/autoload.php';

// TEST ROUTES
//Route::get('test', function(){
//    echo 'test';
//});
//
//Route::get('test1', 'funct_test');
//
//function funct_test(): void
//{
//    echo 'soy una funcion de prueba';
//}

//ROUTES

Route::get('',  [TaskController::class, 'index']);

Route::get('/task/create',  [TaskController::class, 'create']);
Route::get('/task/edit/{id}',  [TaskController::class, 'edit']);
Route::get('/task/delete/{id}',  [TaskController::class, 'delete']);
Route::get('/task/{id}',  [TaskController::class, 'show']);

Route::post('/task',  [TaskController::class, 'store']);
Route::post('/task/update/{id}',  [TaskController::class, 'update']);
Route::post('/task/complete/{id}',  [TaskController::class, 'complete']);


$route = new Route();
$route->dispatch();









