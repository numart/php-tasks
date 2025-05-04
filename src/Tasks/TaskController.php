<?php

namespace Numa\Tasks\Tasks;

class TaskController
{

    public function __construct(private readonly TaskRepositoryInterface $taskRepository) {}

    /**
     * Show tasks list
     *
     * @return void
     */
    public function index()
    {
        $tasks = $this->taskRepository->getAll();

        require dirname(__DIR__, 2).'/public/templates/tasks/index.php';
    }

    public function show($id)
    {
        $task = $this->taskRepository->getByID($id);
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
        $task = $this->taskRepository->getByID($id);
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

            $task = new Task(
              id: $this->taskRepository->getNextId(),
              title: $_POST['name'],
            );

            if ($this->taskRepository->save($task)) {
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
        $task = $this->taskRepository->getByID($id);

        $task->setTitle($_POST['name']);
        $task->setUpdate(time());

        if ($this->taskRepository->save($task)) {
            header('Location: /?task-update=1');
        } else {
            header('Location: /?task-update=0');
        }
    }

    public function delete($id)
    {
        if ($this->taskRepository->delete($id)) {
            header('Location: /?task-delete=1');
        } else {
            header('Location: /?task-delete=0');
        }
    }

    public function complete(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $task = $this->taskRepository->getByID($data['id']);
        $task->setCompleted($data['completed']);
        $this->taskRepository->save($task);
    }

}