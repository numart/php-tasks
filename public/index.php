<?php

use Numa\Tasks\Tasks\TaskController;

include '../vendor/autoload.php';

$taskController = new TaskController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    switch ($uri) {
        case '/add-task':
            $taskController->createTask();
            break;
    }
} else {
    switch ($uri) {
        case '/new-task':
            $taskController->newTask();
            break;
        default:
            $taskController->index();
            break;
    }
}








