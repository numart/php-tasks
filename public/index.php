<?php

use Numa\Tasks\Tasks\TaskController;

include '../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$taskController = new TaskController();

if($uri === '/') {
  $taskController->index();
}
switch ($uri) {
    case '/new-task':
        $taskController->newTask();
        break;
    default:
        $taskController->index();
        break;
}





