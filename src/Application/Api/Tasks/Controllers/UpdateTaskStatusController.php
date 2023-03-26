<?php


namespace Application\Api\Tasks\Controllers;


use Application\Api\Tasks\Requests\UpdateTaskStatusFormRequest;
use Domain\Tasks\Actions\UpdateTaskStatusAction;
use Domain\Tasks\DataTransferObjects\CreateTaskStatusData;
use Domain\Tasks\Models\Task;

class UpdateTaskStatusController
{
    /**
     * Update the specified Task in database.
     *
     * @param Task $task
     * @param UpdateTaskStatusFormRequest $request
     * @param UpdateTaskStatusAction $updateTaskStatusAction
     * @throws \ReflectionException
     */
    public function __invoke(
        Task $task,
        UpdateTaskStatusFormRequest $request,
        UpdateTaskStatusAction $updateTaskStatusAction
    ) : void
    {
        // Convert the HTTP request data to a data transfer object
        $data = CreateTaskStatusData::fromRequest($request);

        // Use the UpdateTaskStatusAction to update the specified Task
        ($updateTaskStatusAction)($task,$data);
    }
}
