<?php


namespace Domain\Task\Actions;


use Domain\Task\Models\Task;

class ListTaskAction
{
    public function __invoke(int $projectId)
    {
        return Task::with('project')
            ->where('project_id', $projectId)
            ->get();
    }
}
