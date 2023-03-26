<?php


namespace Domain\Tasks\Actions;


use Domain\Tasks\DataTransferObjects\CreateTaskStatusData;
use Domain\Tasks\Models\Task;

class UpdateTaskStatusAction
{
    /**
     * Update the specified Task status
     * and save it to the database.
     *
     * @param Task $task
     * @param CreateTaskStatusData $data
     * @return Task
     * @throws \ReflectionException
     */
    public function __invoke(Task $task, CreateTaskStatusData $data) : Task
    {
        // Get the status class based on the status string in the provided data object.
        $className = "Domain\\Tasks\\States\\".ucfirst($data->status);
        $statusClass = new \ReflectionClass($className);

        // transition the Task status to the new  $statusClass.
        $task->status->transitionTo($statusClass->newInstanceWithoutConstructor());

        //save the task
        $task->save();

        return $task->refresh();
    }
}
