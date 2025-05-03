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
            $taskController->store();
            break;
        case 'update-task':
            $taskController->update();
            break;
        case 'complete-task':
            $taskController->complete();
            break;
    }
} else {
    switch ($path) {
        case 'new-task':
            $taskController->create();
            break;
        case 'edit-task':
            if ($param) {
                $taskController->edit($param);
            }
            break;
        case 'delete-task':
            if ($param) {
                $taskController->delete($param);
            }
            break;
        default:
            $taskController->index();
            break;
    }
}








