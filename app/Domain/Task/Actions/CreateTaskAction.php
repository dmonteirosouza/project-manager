<?php


namespace Domain\Task\Actions;


use Domain\Task\DTO\TaskDTO;
use Domain\Task\Models\Task;

class CreateTaskAction
{
    public function __invoke(TaskDTO $projectDTO): Task
    {
        return Task::create([
            'project_id' => $projectDTO->project_id,
            'name' => $projectDTO->name,
            'start' => $projectDTO->start,
            'finish' => $projectDTO->finish,
            'status' => $projectDTO->status ?? false,
        ]);
    }
}
