<?php


namespace App\Api\Project\Controllers;


use App\Api\Project\Requests\ProjectRequest;
use App\Core\Http\Controllers\Controller;
use Domain\Projects\Actions\CreateProjectAction;
use Domain\Projects\Actions\DeleteProjectAction;
use Domain\Projects\Actions\ListProjectAction;
use Domain\Projects\DTO\ProjectDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ProjectController extends Controller
{
    public function index(ListProjectAction $action)
    {
        $response = [
            'error' => false,
            'payload' => $action()
        ];

        return response()->json($response)->setStatusCode(Response::HTTP_OK);
    }

    public function store(ProjectRequest $request, CreateProjectAction $action)
    {
        try {
            $data = ProjectDTO::fromRequest($request);

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

    public function destroy(Request $request, DeleteProjectAction $action)
    {
        try {
            $response = [
                'error' => false,
                'payload' => $action($request->route('project_id'))
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
