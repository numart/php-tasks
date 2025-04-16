<?php

namespace Numa\Tasks\Tasks;

class TaskController
{

    public function index()
    {
        $taskManager = new TaskManager();
        $tasks = $taskManager->getTasks();

        require dirname(__DIR__, 2).'/public/templates/tasks.php';
    }

    public function newTask()
    {
        require dirname(__DIR__, 2).'/public/templates/newTask.php';
    }

}