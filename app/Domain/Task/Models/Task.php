<?php


namespace Domain\Task\Models;


use Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'start',
        'finish',
        'status',
    ];

    protected $casts = [
        'start' => 'date:Y-m-d',
        'finish' => 'date:Y-m-d',
        'status' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
