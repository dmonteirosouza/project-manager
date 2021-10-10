<?php


namespace Domain\Project\Actions;


use Carbon\Carbon;
use Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Collection;

final class ListProjectAction
{
    public function __invoke()
    {
        /** @var Collection $projects */
        $projects = Project::with('tasks')
            ->withCount([
                'tasksComplete',
                'tasksIncomplete'
            ])->get();

        $projects->map(function ($project) {
            /** @var Collection $tasks */
            $tasks = $project->tasks;
            $tasksComplete = $project->tasks_complete_count;
            $tasksIncomplete = $project->tasks_incomplete_count;

            unset($project->tasks);
            unset($project->tasks_complete_count);
            unset($project->tasks_incomplete_count);

            $totalTasks = ($tasksComplete + $tasksIncomplete);

            $percent = ($tasksComplete / ($totalTasks ?: 1)) * 100;

            $project->percent = (float)number_format($percent, 2);

            $project->deadline = $tasks
                    ->where('finish', '>', $project->finish)
                    ->sortByDesc('finish')
                    ->first() || Carbon::now()->format('Y-m-d') > $project->finish;

            return $project;
        });

        return $projects;
    }
}
