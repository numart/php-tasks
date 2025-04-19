<?php

use Numa\Tasks\Tasks\TaskController;

include '../vendor/autoload.php';

$taskController = new TaskController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$uriArr = explode('/', $uri);
$path = $uriArr[1] ?? '';
$param = $uriArr[2] ?? null;


if ($method == 'POST') {
    switch ($path) {
        case 'add-task':
            $taskController->createTask();
            break;
    }
} else {
    switch ($path) {
        case 'new-task':
            $taskController->newTask();
            break;
        case 'edit-task':
            break;
        case 'delete-task':
            if($param){
                $taskController->deleteTask($param);
            }
            break;
        default:
            $taskController->index();
            break;
    }
}








