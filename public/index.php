<?php

use Numa\Tasks\Route;
use Numa\Tasks\Tasks\TaskController;

include '../vendor/autoload.php';
//
//$taskController = new TaskController();
//
//$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$method = $_SERVER['REQUEST_METHOD'];
//
//$uriArr = explode('/', $uri);
//$path = $uriArr[1] ?? '';
//$param = $uriArr[2] ?? null;
//
//if ($method == 'POST') {
//    switch ($path) {
//        case 'add-task':
//            $taskController->store();
//            break;
//        case 'update-task':
//            $taskController->update();
//            break;
//        case 'complete-task':
//            $taskController->complete();
//            break;
//    }
//} else {
//    switch ($path) {
//        case 'new-task':
//            $taskController->create();
//            break;
//        case 'edit-task':
//            if ($param) {
//                $taskController->edit($param);
//            }
//            break;
//        case 'delete-task':
//            if ($param) {
//                $taskController->delete($param);
//            }
//            break;
//        default:
//            $taskController->index();
//            break;
//    }
//}



// TEST ROUTES
Route::get('test', function(){
    echo 'test';
});

Route::get('test1', 'funct_test');

function funct_test(): void
{
    echo 'soy una funcion de prueba';
}

//ROUTES

Route::get('',  [TaskController::class, 'index']);
Route::get('/task/create',  [TaskController::class, 'create']);
Route::post('/task',  [TaskController::class, 'store']);


$route = new Route();
$route->dispatch();









