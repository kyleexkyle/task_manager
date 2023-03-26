<?php


namespace Domain\Tasks\Actions;


use Domain\Tasks\DataTransferObjects\CreateTaskData;
use Domain\Tasks\Models\Task;

class UpdateTaskAction
{
    /**
     * Update the specified Task
     * and save it to the database.
     *
     * @param Task $task
     * @param CreateTaskData $data
     * @return Task
     * @throws \ReflectionException
     */
    public function __invoke(Task $task, CreateTaskData $data) : Task
    {
        // Get the status class based on the status string in the provided data object.
        $className = "Domain\\Tasks\\States\\".ucfirst($data->status);
        $statusClass = new \ReflectionClass($className);

        // fill in the task data using the data object
        $task->title = $data->title;
        $task->description = $data->description;
        $task->due_date = $data->due_date;

        // transition the Task status to the new  $statusClass.
        $task->status->transitionTo($statusClass->newInstanceWithoutConstructor());

        //save the task
        $task->save();

        return $task->refresh();
    }
}
