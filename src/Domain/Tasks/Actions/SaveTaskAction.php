<?php


namespace Domain\Tasks\Actions;


use Domain\Tasks\DataTransferObjects\CreateTaskData;
use Domain\Tasks\Models\Task;

class SaveTaskAction
{
    /**
     * Save the Task to the database
     *
     * @param CreateTaskData $data
     * @return Task
     */
    public function __invoke(CreateTaskData $data) : Task
    {
        $task = Task::create([
            'title' => ucwords($data->title),
            'description' => $data->description,
            'due_date' => $data->due_date
        ]);

        return $task->refresh();
    }
}
