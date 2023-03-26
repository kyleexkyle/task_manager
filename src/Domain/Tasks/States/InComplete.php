<?php


namespace Domain\Tasks\States;


class InComplete extends TaskState
{
    /**
     * The name of this Task Status
     *
     * @var string
     */
    public static string $name = 'incomplete';

    /**
     * Get the color associated with this Task Status
     *
     * @return string
     */
    public function getColor(): string
    {
        return 'red';
    }
}
