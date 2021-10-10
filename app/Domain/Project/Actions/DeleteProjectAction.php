<?php


namespace Domain\Project\Actions;


use Domain\Project\Models\Project;

final class DeleteProjectAction
{
    public function __invoke(int $projectId): bool
    {
        return Project::destroy($projectId);
    }
}
