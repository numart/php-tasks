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
        $tasks = $taskManager->getAll();

        require dirname(__DIR__, 2).'/public/templates/tasks/index.php';
    }

    /**
     * New task form
     *
     * @return void
     */
    public function create()
    {
        require dirname(__DIR__, 2).'/public/templates/tasks/create.php';
    }

    /**
     * Show edit form
     *
     * @return void
     */
    public function edit($id)
    {
        $taskManager = new TaskManager();
        $task = $taskManager->getByID($id);
        require dirname(__DIR__, 2).'/public/templates/tasks/edit.php';
    }

    /**
     * Get new task form info
     *
     * @return void
     */
    public function store()
    {
        if (isset($_POST['name'])) {
            $taskManager = new TaskManager();

            $task = new Task(
              $taskManager->getNextId(), $_POST['name'], '', date('Y-m-d'), date('Y-m-d'), 0
            );

            if ($taskManager->store($task)) {
                header('Location: /?task-create=1');
            } else {
                header('Location: /?task-create=0');
            }
        }
    }

    public function delete($id)
    {
        $taskManager = new TaskManager();

        if ($taskManager->remove($id)) {
            header('Location: /?task-delete=1');
        } else {
            header('Location: /?task-delete=0');
        }
    }

}