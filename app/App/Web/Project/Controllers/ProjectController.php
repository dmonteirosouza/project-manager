<?php


namespace App\Web\Project\Controllers;


use App\Core\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Project/Index');
    }
}
