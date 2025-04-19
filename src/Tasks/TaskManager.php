<?php

namespace Numa\Tasks\Tasks;

class TaskManager
{

    private $jsonPath = __DIR__.'/tasks.json';

    private $tasks = [];

    public function __construct()
    {
        $tasks_arr = json_decode(file_get_contents($this->jsonPath), true);

        foreach ($tasks_arr as $task) {
            $this->tasks[$task['id']] = new Task(...$task);
        }
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getTask($taskId)
    {
        return $this->tasks[$taskId];
    }

    public function addTask(Task $task)
    {
        $this->tasks[$task->getId()] = $task;
        return $this->writeTasks();
    }

    public function removeTask($taskId)
    {
        unset($this->tasks[$taskId]);
        return $this->writeTasks();
    }

    private function writeTasks()
    {
        return file_put_contents($this->jsonPath, json_encode($this->tasks));
    }

}