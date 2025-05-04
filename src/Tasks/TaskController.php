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

    public function show($id)
    {
        $taskManager = new TaskManager();
        $task = $taskManager->getByID($id);
        echo $task->getId().' - '.$task->getTitle().' - '.$task->getDescription(
          );
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
              id: $taskManager->getNextId(), title: $_POST['name'],
            );

            if ($taskManager->save($task)) {
                header('Location: /?task-create=1');
            } else {
                header('Location: /?task-create=0');
            }
        }
    }

    /**
     *
     * @return void
     */
    public function update($id)
    {
        $taskManager = new TaskManager();
        $task = $taskManager->getByID($id);

        $task->setTitle($_POST['name']);
        $task->setUpdate(time());

        if ($taskManager->save($task)) {
            header('Location: /?task-update=1');
        } else {
            header('Location: /?task-update=0');
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

    public function complete(): void
    {
        $taskManager = new TaskManager();
        $data = json_decode(file_get_contents("php://input"), true);
        $task = $taskManager->getByID($data['id']);
        $task->setCompleted($data['completed']);
        $taskManager->save($task);
    }

}