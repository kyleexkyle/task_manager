<?php


namespace Domain\Tasks\DataTransferObjects;


use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Data;

class CreateTaskData extends Data
{
    /**
     * CreateTaskData constructor.
     * @param string $title
     * @param string $description
     * @param string $due_date
     * @param string|null $status
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $due_date,
        public ?string $status) {

    }

    /**
     * Create a new instance of CreateTaskData
     * from a FormRequest instance
     *
     * @param FormRequest $request
     * @return static
     */
    public static function fromRequest(FormRequest $request) : static
    {
        return new self(
            $request->input('title'),
            $request->input('description'),
            $request->input('due_date'),
            $request->input('status')
        );
    }
}
