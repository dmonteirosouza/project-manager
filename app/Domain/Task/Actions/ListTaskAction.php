<?php


namespace Domain\Task\Actions;


use Domain\Task\Models\Task;

class ListTaskAction
{
    public function __invoke(int $projectId)
    {
        return Task::where('project_id', $projectId)->get();
    }
}
