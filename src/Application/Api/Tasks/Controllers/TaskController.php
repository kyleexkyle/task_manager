<?php


namespace Application\Api\Tasks\Controllers;


use App\Http\Controllers\Controller;
use Application\Api\Tasks\Requests\CreateTaskFormRequest;
use Application\Api\Tasks\Requests\UpdateTaskFormRequest;
use Application\Api\Tasks\Resources\TaskCollection;
use Application\Api\Tasks\Resources\TaskResource;
use Domain\Tasks\Actions\CreateTaskAction;
use Domain\Tasks\Actions\DeleteTaskAction;
use Domain\Tasks\Actions\UpdateTaskAction;
use Domain\Tasks\DataTransferObjects\CreateTaskData;
use Domain\Tasks\Models\Task;
use Domain\Tasks\Queries\TaskIndexQuery;
use Domain\Tasks\ViewModels\TaskFormViewModel;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TaskIndexQuery $query
     * @return Response
     */
    public function index(TaskIndexQuery $query) : Response
    {
        // Retrieve the tasks from the database using the provided query object.
        $tasks = $query->get();

        // Render the task index view.
        return Inertia::render('Task/Index',[
            'tasks' => new TaskCollection($tasks),
            'taskStates' => Task::getStates()
        ]);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create() : Response
    {
        // Render the task create view.
        return Inertia::render('Task/Create');
    }

    /**
     * Store a newly created Task in database.
     *
     * @param CreateTaskFormRequest $request
     * @param CreateTaskAction $createTaskAction
     */
    public function store(CreateTaskFormRequest $request, CreateTaskAction $createTaskAction)
    {
        // Convert the HTTP request data to a data transfer object
        $data = CreateTaskData::fromRequest($request);

        // Use the CreateTaskAction to create a task
        ($createTaskAction)($data);
    }

    /**
     * Display the specified Task.
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task) : Response
    {
        // Render the task show view.
        return Inertia::render('Task/Show',[
            'task' => new TaskResource($task)
        ]);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param Task $task
     * @return Response
     */
    public function edit(Task $task) : Response
    {
        // Render the task edit form view.
        return Inertia::render('Task/Edit',[
            'data' => new TaskFormViewModel($task)
        ]);
    }

    /**
     * Update the specified Task in database.
     *
     * @param Task $task
     * @param UpdateTaskFormRequest $request
     * @param UpdateTaskAction $updateTaskAction
     * @throws \ReflectionException
     */
    public function update(Task $task, UpdateTaskFormRequest $request, UpdateTaskAction $updateTaskAction) : void
    {
        // Convert the HTTP request data to a data transfer object
        $data = CreateTaskData::fromRequest($request);

        // Use the UpdateTaskAction to update the specified Task
        ($updateTaskAction)($task,$data);
    }

    /**
     * Remove the specified Task from database.
     *
     * @param Task $task
     * @param DeleteTaskAction $deleteTaskAction
     */
    public function destroy(Task $task, DeleteTaskAction $deleteTaskAction) : void
    {
        // Use the DeleteTaskAction to delete the specified Task
        ($deleteTaskAction)($task);
    }
}
