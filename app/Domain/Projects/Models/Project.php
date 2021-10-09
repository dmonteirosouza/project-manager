<?php


namespace Domain\Projects\Models;


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
}
