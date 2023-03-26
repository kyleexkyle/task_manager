<?php


namespace Domain\Tasks\Observers;


use Domain\Tasks\Models\Task;

class TaskObserver
{
    /**
     * Handle the Job "creating" event.
     *
     * @param Task $task
     */
    public function creating(Task $task)
    {
        $task->user_id = auth()->user()->id;
    }
}
