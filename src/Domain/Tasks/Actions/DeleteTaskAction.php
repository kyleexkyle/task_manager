<?php


namespace Domain\Tasks\Actions;


use Domain\Tasks\Models\Task;

class DeleteTaskAction
{
    /**
     * Delete the Task from database.
     *
     * @param Task $task
     * @return bool
     */
    public function __invoke(Task $task) : bool
    {
        return $task->delete();
    }
}
