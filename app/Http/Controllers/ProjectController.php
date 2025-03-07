<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::get();

        return response()->json($project);
    }

    public function show($id)
    {
        // Загружаем проект вместе с его изображениями
        $project = Project::with(['translation', 'images'])->findOrFail($id);

        return response()->json($project);
    }
}
