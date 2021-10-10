<?php


namespace Domain\Project\Models;


use Domain\Task\Models\Task;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'start',
        'finish',
    ];

    protected $casts = [
        'start' => 'date:Y-m-d',
        'finish' => 'date:Y-m-d',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tasksComplete()
    {
        return $this->hasMany(Task::class)->where('status', true);
    }

    public function tasksIncomplete()
    {
        return $this->hasMany(Task::class)->where('status', false);
    }
}
