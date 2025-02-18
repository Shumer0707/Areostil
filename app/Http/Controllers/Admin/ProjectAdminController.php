<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectImage;

class ProjectAdminController extends Controller
{
    public function index(): Response
    {
        $projects = Project::latest()->get();

        return Inertia::render('Admin/AdminProjects', [
            'projects' => $projects,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/AdminProjectCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'nullable|string',
            'client' => 'nullable|string',
            'trend' => 'nullable|string',
            'full_desc' => 'nullable|string',
        ]);

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Проект успешно создан.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return Inertia::render('Admin/AdminProjectEdit', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'nullable|string',
            'client' => 'nullable|string',
            'trend' => 'nullable|string',
            'full_desc' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Проект обновлён.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Проект удалён.');
    }

    public function images($id)
    {
        $project = Project::findOrFail($id);
        $images = $project->images; // Загружаем связанные изображения

        return Inertia::render('Admin/AdminProjectImages', [
            'project' => $project,
            'images' => $images,
        ]);
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $project = Project::findOrFail($id);

        $path = $request->file('image')->store('project_images', 'public');

        ProjectImage::create([
            'project_id' => $project->id,
            'image_path' => asset('storage/' . $path), // Формируем корректный путь
        ]);

        return redirect()->back()->with('success', 'Изображение загружено.');
    }

    public function deleteImage($id, $imageId)
    {
        $image = ProjectImage::where('project_id', $id)->findOrFail($imageId);

        Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_path));

        $image->delete();

        return redirect()->back()->with('success', 'Изображение удалено.');
    }

    public function setCover(Request $request, $id)
    {
        $request->validate([
            'image_id' => 'required|exists:project_images,id',
        ]);

        $image = ProjectImage::findOrFail($request->image_id);

        $project = Project::findOrFail($id);
        $project->cover_image = $image->image_path;
        $project->save();

        return redirect()->back()->with('success', 'Обложка установлена.');
    }
}
