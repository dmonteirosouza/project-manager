<?php


namespace Domain\Projects\Actions;


use Domain\Projects\Models\Project;

final class ListProjectAction
{
    public function __invoke()
    {
        return Project::all();
    }
}
