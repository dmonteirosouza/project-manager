<?php


namespace Domain\Task\DTO;


use App\Api\Task\Requests\TaskRequest;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class TaskDTO extends DataTransferObject
{
    /** @var int */
    public $project_id;

    /** @var string */
    public $name;

    /** @var Carbon */
    public $start;

    /** @var Carbon */
    public $finish;

    /** @var boolean */
    public $status;

    public static function fromRequest(TaskRequest $taskRequest): TaskDTO
    {
        return new Self([
            'project_id' => $taskRequest->route('project_id'),
            'name' => $taskRequest->get('name'),
            'start' => Carbon::make($taskRequest->get('start')),
            'finish' => Carbon::make($taskRequest->get('finish')),
            'status' => $taskRequest->get('status'),
        ]);
    }
}
