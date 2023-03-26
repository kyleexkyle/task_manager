<?php


namespace Domain\Tasks\Models;


use Domain\Tasks\States\TaskState;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Task extends Model
{
    use HasStates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date:Y-m-d',
        'status' => TaskState::class
    ];


    /**
     * make due date format as d-m-Y
     * @return string
     */
    public function getDateAttribute() : string
    {
        return $this->due_date->format('d-m-Y');
    }


    /**
     * only take the tasks the belongs to
     * the authenticated user
     *
     * @param $query
     * @return mixed
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }
}
