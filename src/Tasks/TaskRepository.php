<?php

namespace Numa\Tasks\Tasks;

class TaskRepository implements TaskRepositoryInterface
{

    private $jsonPath = __DIR__.'/tasks.json';

    private $tasks = [];

    public function __construct()
    {
        $tasks_arr = json_decode(file_get_contents($this->jsonPath), true);

        if(!empty($tasks_arr)) {
            foreach ($tasks_arr as $task) {
                $this->tasks[$task['id']] = new Task(...$task);
            }
        }

    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->tasks;
    }

    /**
     * @param $taskId
     *
     * @return Task
     */
    public function getByID($taskId): ?Task
    {
        return $this->tasks[$taskId];
    }

    /**
     * @param  \Numa\Tasks\Tasks\Task  $task
     *
     * @return false|int
     */
    public function save(Task $task): bool
    {
        $this->tasks[$task->getId()] = $task;
        return $this->write();
    }

    /**
     * @param $taskId
     *
     * @return false|int
     */
    public function delete($id): bool
    {
        unset($this->tasks[$id]);
        return $this->write();
    }

    /**
     * @return false|int
     */
    private function write()
    {
        return file_put_contents($this->jsonPath, json_encode($this->tasks));
    }

    public function getNextId() {
        $last_id = array_key_last($this->tasks);
        return $last_id + 1;
    }

}