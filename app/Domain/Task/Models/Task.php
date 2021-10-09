<?php


namespace Domain\Task\Models;


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
    ];
}
