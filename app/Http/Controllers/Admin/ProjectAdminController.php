<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectImage;
use App\Models\ProjectTranslation;

class ProjectAdminController extends Controller
{

    public function index(): Response
    {
        $locale = app()->getLocale();
        $projects = Project::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();

        return Inertia::render('Admin/AdminProjects', [
            'projects' => $projects
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/AdminProjectCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'trend' => 'required|string|max:255',
            'translations' => 'required|array',
            'translations.ru.title' => 'required|string|max:255',
            'translations.ru.short_desc' => 'nullable|string',
            'translations.ru.full_desc' => 'nullable|string',
            'translations.ro.title' => 'required|string|max:255',
            'translations.ro.short_desc' => 'nullable|string',
            'translations.ro.full_desc' => 'nullable|string',
        ]);

        // 1️⃣ Создаём новый проект
        $project = Project::create([
            'client' => $validated['client'],
            'trend' => $validated['trend'],
        ]);

        // 2️⃣ Добавляем переводы (русский и румынский)
        foreach (['ru', 'ro'] as $locale) {
            ProjectTranslation::create([
                'project_id' => $project->id,
                'locale' => $locale,
                'title' => $validated['translations'][$locale]['title'],
                'short_desc' => $validated['translations'][$locale]['short_desc'] ?? null,
                'full_desc' => $validated['translations'][$locale]['full_desc'] ?? null,
            ]);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Проект создан.');
    }

    public function edit($id)
    {
        $project = Project::with('translations')->findOrFail($id);

        return Inertia::render('Admin/AdminProjectEdit', [
            'project' => $project,
            'translations' => $project->translations->mapWithKeys(function ($translation) {
                return [$translation->locale => [
                    'title' => $translation->title,
                    'short_desc' => $translation->short_desc,
                    'full_desc' => $translation->full_desc,
                ]];
            }),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'trend' => 'required|string|max:255',
            'translations' => 'required|array',
            'translations.ru.title' => 'required|string|max:255',
            'translations.ru.short_desc' => 'nullable|string',
            'translations.ru.full_desc' => 'nullable|string',
            'translations.ro.title' => 'required|string|max:255',
            'translations.ro.short_desc' => 'nullable|string',
            'translations.ro.full_desc' => 'nullable|string',
        ]);

        // 1️⃣ Обновляем сам проект
        $project = Project::findOrFail($id);
        $project->update([
            'client' => $validated['client'],
            'trend' => $validated['trend'],
        ]);

        // 2️⃣ Обновляем переводы (если они уже есть) или создаём новые
        foreach (['ru', 'ro'] as $locale) {
            ProjectTranslation::updateOrCreate(
                ['project_id' => $project->id, 'locale' => $locale],
                [
                    'title' => $validated['translations'][$locale]['title'],
                    'short_desc' => $validated['translations'][$locale]['short_desc'] ?? null,
                    'full_desc' => $validated['translations'][$locale]['full_desc'] ?? null,
                ]
            );
        }

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
        $locale = app()->getLocale();
        $project = Project::where('id', $id)->with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->firstOrFail();
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
