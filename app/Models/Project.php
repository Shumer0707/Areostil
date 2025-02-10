<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Указываем поля, которые могут быть массово заполнены
    protected $fillable = [
        'title',
        'short_desc',
        'cover_image',
        'client',
        'full_desc'
    ];

    // Связь: проект имеет много изображений
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
