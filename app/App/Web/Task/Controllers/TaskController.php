<?php


namespace App\Web\Task\Controllers;


use App\Core\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Task/Index');
    }
}
