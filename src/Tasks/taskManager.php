<?php
namespace Numa\Tasks;

class TaskManager
{
    const FILE = 'tasks.json';

    private $tasks = [];

    public function __construct()
    {
        $tasks = json_decode(file_get_contents(self::FILE), true);
        //TODO: convertir json to TASK object
    }

//    private function readFile()
//    {
//        $fileContent = file_get_contents(self::FILE);
//        $tasks = json_decode($fileContent, true);
//        $this->tasks = $tasks;
//    }

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

    }

}