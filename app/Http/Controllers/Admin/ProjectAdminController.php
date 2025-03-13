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

        // ✅ Очищаем и форматируем данные перед сохранением
        $client = trim($validated['client']);
        $trend = trim($validated['trend']);

        // Если строка после trim стала пустой — заменяем её на NULL
        $client = $client !== '' ? $client : null;
        $trend = $trend !== '' ? $trend : null;

        // 1️⃣ Создаём новый проект
        $project = Project::create([
            'client' => $client,
            'trend' => $trend,
        ]);

        // 2️⃣ Добавляем переводы (русский и румынский)
        foreach (['ru', 'ro'] as $locale) {
            $title = trim($validated['translations'][$locale]['title']);
            $short_desc = trim($validated['translations'][$locale]['short_desc'] ?? '');
            $full_desc = trim($validated['translations'][$locale]['full_desc'] ?? '');

            // Если строки после trim() пустые — делаем NULL
            $short_desc = $short_desc !== '' ? $short_desc : null;
            $full_desc = $full_desc !== '' ? $full_desc : null;

            ProjectTranslation::create([
                'project_id' => $project->id,
                'locale' => $locale,
                'title' => $title,
                'short_desc' => $short_desc,
                'full_desc' => $full_desc,
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

        // ✅ Очищаем и форматируем данные перед обновлением
        $client = trim($validated['client']);
        $trend = trim($validated['trend']);

        // Если строка после trim стала пустой — заменяем её на NULL
        $client = $client !== '' ? $client : null;
        $trend = $trend !== '' ? $trend : null;

        // 1️⃣ Обновляем сам проект
        $project = Project::findOrFail($id);
        $project->update([
            'client' => $client,
            'trend' => $trend,
        ]);

        // 2️⃣ Обновляем переводы (если они уже есть) или создаём новые
        foreach (['ru', 'ro'] as $locale) {
            $title = trim($validated['translations'][$locale]['title']);
            $short_desc = trim($validated['translations'][$locale]['short_desc'] ?? '');
            $full_desc = trim($validated['translations'][$locale]['full_desc'] ?? '');

            // Если строки после trim() пустые — делаем NULL
            $short_desc = $short_desc !== '' ? $short_desc : null;
            $full_desc = $full_desc !== '' ? $full_desc : null;

            ProjectTranslation::updateOrCreate(
                ['project_id' => $project->id, 'locale' => $locale],
                [
                    'title' => $title,
                    'short_desc' => $short_desc,
                    'full_desc' => $full_desc,
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
        $validated = $request->validate([
            'images' => 'required|array', // ✅ Проверяем, что пришёл массив файлов
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ✅ Каждое изображение проходит валидацию
        ]);

        $project = Project::findOrFail($id);
        $uploadedImages = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store("projects/{$project->id}", 'public'); // ✅ Сохраняем в storage/public/projects/{id}

            $uploadedImages[] = ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => asset('storage/' . $path), // ✅ Формируем корректный путь
            ]);
        }

        return back()->with([
            'success' => 'Изображения загружены.',
            'uploadedImages' => $uploadedImages, // ✅ Возвращаем загруженные файлы (если нужно)
        ]);
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
