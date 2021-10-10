<?php


namespace Domain\Task\Actions;


use Domain\Task\Models\Task;
use Exception;

final class DeleteTaskAction
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
            return $task->delete();
        }

        throw new Exception('This task doesn\'t belong to the project');
    }
}
