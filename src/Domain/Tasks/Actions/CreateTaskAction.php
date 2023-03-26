<?php


namespace Domain\Tasks\Actions;


use Domain\Tasks\DataTransferObjects\CreateTaskData;
use Domain\Tasks\Models\Task;

class CreateTaskAction
{
    /**
     * CreateTaskAction constructor.
     * @param SaveTaskAction $saveTaskAction
     */
    public function __construct(
        private SaveTaskAction $saveTaskAction
    ) {}

    /**
     * Create a new Task using the provided
     * data and pass it to the saveTaskAction
     *
     * @param CreateTaskData $data
     * @return Task
     */
    public function __invoke(CreateTaskData $data) : Task
    {
        // Use the CreateTaskData to save the Task
        return ($this->saveTaskAction)($data);
    }
}
