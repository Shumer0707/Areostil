<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['client', 'cover_image', 'trend'];

    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    // ✅ Добавляем новое отношение для одного нужного перевода
    public function translation()
    {
        return $this->hasOne(ProjectTranslation::class)->where('locale', App::getLocale());
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
