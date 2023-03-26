<?php


namespace Domain\Tasks\ViewModels;


use Domain\Tasks\Models\Task;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TaskFormViewModel extends ViewModel
{
    /**
     * TaskFormViewModel constructor.
     * @param Task|null $task The Task instance to use
     * as the view model's main data. If null, a new T
     * ask instance is created.
     */
    public function __construct(public ?Task $task = null)
    {
        $this->task = $this->task ?? new Task();
    }

    /**
     * Get a collection of all possible states for a Task.
     *
     * @return Collection
     */
    public function taskStates() : Collection
    {
        return Task::getStates();
    }
}
