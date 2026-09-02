<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image_path',
        'link',
        'tags',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('sort_order');
    }

    protected static function booted(): void
    {
        static::saving(function (self $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title) ?: uniqid();
            }
        });
    }
}
