<?php


namespace Domain\Project\Actions;


use Domain\Project\DTO\ProjectDTO;
use Domain\Project\Models\Project;

final class CreateProjectAction
{
    public function __invoke(ProjectDTO $projectDTO): Project
    {
        return Project::create([
           'name' => $projectDTO->name,
           'start' => $projectDTO->start,
           'finish' => $projectDTO->finish,
        ]);
    }
}
