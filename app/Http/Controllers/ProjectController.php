<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['translations', 'images'])->get();
        return response()->json($projects);
    }

    public function show($id)
    {
        // Загружаем проект вместе с его изображениями
        $project = Project::with('images')->findOrFail($id);

        return response()->json($project);
    }
}
