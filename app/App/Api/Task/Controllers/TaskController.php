<?php


namespace App\Api\Task\Controllers;


use App\Api\Task\Requests\TaskRequest;
use App\Api\Task\Requests\TaskStatusRequest;
use App\Core\Http\Controllers\Controller;
use Domain\Project\Actions\DeleteProjectAction;
use Domain\Task\Actions\CreateTaskAction;
use Domain\Task\Actions\DeleteTaskAction;
use Domain\Task\Actions\ListTaskAction;
use Domain\Task\Actions\UpdateTaskAction;
use Domain\Task\DTO\TaskDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class TaskController extends Controller
{
    public function index(Request $request, ListTaskAction $action)
    {
        $response = [
            'error' => false,
            'payload' => $action($request->route('project_id'))
        ];

        return response()->json($response)->setStatusCode(Response::HTTP_OK);
    }

    public function store(TaskRequest $request, CreateTaskAction $action)
    {
        try {
            $data = TaskDTO::fromRequest($request);

            $response = [
                'error' => false,
                'payload' => $action($data)
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_CREATED);

        } catch (Throwable $throwable) {
            $response = [
                'error' => true,
                'payload' => $throwable->getMessage()
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, UpdateTaskAction $action)
    {
        try {
            $response = [
                'error' => false,
                'payload' => $action($request->route('project_id'), $request->route('task_id'))
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_OK);

        } catch (Throwable $throwable) {
            $response = [
                'error' => true,
                'payload' => $throwable->getMessage()
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Request $request, DeleteTaskAction $action)
    {
        try {
            $response = [
                'error' => false,
                'payload' => $action($request->route('project_id'), $request->route('task_id'))
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_OK);
        } catch (Throwable $throwable) {
            $response = [
                'error' => true,
                'payload' => $throwable->getMessage()
            ];

            return response()->json($response)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
