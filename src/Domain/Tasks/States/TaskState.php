<?php


namespace Domain\Tasks\States;



use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TaskState extends State
{
    /**
     * Get the color associated with this Task State
     * This method must be implemented by any concrete
     * Task State classes that extend this abstract class.
     *
     * @return string
     */
    abstract public function getColor() : string;

    /**
     * Configure the states and transitions for the Task State.
     * This method uses the Spatie Model States package to define
     * the states and transitions for the Task State.
     *
     * @return StateConfig
     * @throws \Spatie\ModelStates\Exceptions\InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(InComplete::class)
            ->allowTransition(InComplete::class,Complete::class)
            ->allowTransition(Complete::class,InComplete::class)
            ->allowTransition(Complete::class,Complete::class)
            ->allowTransition(InComplete::class,InComplete::class);
    }
}
