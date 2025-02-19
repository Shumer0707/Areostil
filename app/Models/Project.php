<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['client', 'trend'];

    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
    // Связь: проект имеет много изображений
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
