<?php

namespace Numa\Tasks\Tasks;

class TaskController
{

    /**
     * Show tasks list
     *
     * @return void
     */
    public function index()
    {
        $taskManager = new TaskManager();
        $tasks = $taskManager->getTasks();

        require dirname(__DIR__, 2).'/public/templates/tasks.php';
    }

    /**
     * New task form
     *
     * @return void
     */
    public function newTask()
    {
        require dirname(__DIR__, 2).'/public/templates/newTask.php';
    }

    /**
     * Get new task form info
     *
     * @return void
     */
    public function createTask()
    {
        if(isset($_POST['name'])) {

            $taskManager = new TaskManager();
            $tasks = $taskManager->getTasks();
            $last_id = array_key_last($tasks);

            $task = new Task( $last_id + 1, $_POST['name'],  date('Y-m-d'), 0);
            $taskManager->addTask($task);

            if($taskManager->addTask($task)) {
                header('Location: /?task-create=1');
            }else {
                header('Location: /?task-create=1');
            }
        }
    }

}