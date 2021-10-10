<?php


namespace Domain\Projects\Actions;


use Domain\Projects\DTO\ProjectDTO;
use Domain\Projects\Models\Project;

final class DeleteProjectAction
{
    public function __invoke(int $projectId): bool
    {
        return Project::destroy($projectId);
    }
}
