<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    protected $fillable = ['project_id', 'locale', 'title', 'short_desc', 'full_desc'];
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
