<?php


namespace Domain\Task\Actions;


use Domain\Task\DTO\TaskDTO;
use Domain\Task\Models\Task;
use Exception;

class UpdateTaskAction
{
    /**
     * @throws Exception
     */
    public function __invoke(int $projectId, int $taskId): bool
    {
        $task = Task::where([
            'project_id' => $projectId,
            'id' => $taskId,
        ])->first();

        if ($task) {
            $task->status = !$task->status;
            $task->save();

            return $task->status;
        }

        throw new Exception('This task doesn\'t belong to the project');
    }
}
