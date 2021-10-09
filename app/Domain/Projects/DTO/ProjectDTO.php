<?php


namespace Domain\Projects\DTO;


use App\Api\Project\Requests\ProjectRequest;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectDTO extends DataTransferObject
{
    /** @var string */
    public string $name;

    /** @var Carbon */
    public Carbon $start;

    /** @var Carbon */
    public Carbon $finish;

    public static function fromRequest(ProjectRequest $projectRequest): ProjectDTO
    {
        return new Self([
            'name' => $projectRequest->get('name'),
            'start' => Carbon::make($projectRequest->get('start')),
            'finish' => Carbon::make($projectRequest->get('finish')),
        ]);
    }
}
