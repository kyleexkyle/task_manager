<?php


namespace Domain\Tasks\Queries;


use Domain\Tasks\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

class TaskIndexQuery extends QueryBuilder
{
    /**
     * TaskIndexQuery constructor.
     * build the query for the index method on TaskController
     */
    public function __construct()
    {
        $subject = Task::query()->mine()->orderBy('created_at','desc');

        parent::__construct($subject);
    }
}
