<?php


namespace Domain\Tasks\DataTransferObjects;


use Application\Api\Tasks\Requests\UpdateTaskStatusFormRequest;
use Spatie\LaravelData\Data;

class CreateTaskStatusData extends Data
{
    /**
     * CreateTaskStatusData constructor.
     * @param string $status
     */
    public function __construct(
        public string $status) {

    }

    /**
     * Create a new instance of CreateTaskStatusData
     * from a UpdateTaskStatusFormRequest instance
     *
     * @param UpdateTaskStatusFormRequest $request
     * @return static
     */
    public static function fromRequest(UpdateTaskStatusFormRequest $request) : static
    {
        return new self(
            $request->input('status')
        );
    }
}
