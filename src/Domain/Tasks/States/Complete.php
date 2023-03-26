<?php


namespace Domain\Tasks\States;


class Complete extends TaskState
{
    /**
     * The name of this Task Status
     *
     * @var string
     */
    public static string $name = 'complete';

    /**
     * Get the color associated with this Task Status
     *
     * @return string
     */
    public function getColor(): string
    {
        return 'green';
    }
}
