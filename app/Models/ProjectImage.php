<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    // Указываем таблицу (по умолчанию Laravel ищет table `project_images`, так что можно не указывать)
    protected $table = 'project_images';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'project_id',
        'image_path',
        'caption'
    ];

    // Связь: каждое изображение принадлежит проекту
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
