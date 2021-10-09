<?php


namespace Domain\Projects\Actions;


use Domain\Projects\DTO\ProjectDTO;
use Domain\Projects\Models\Project;

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
