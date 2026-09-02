<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'hero_greeting',
        'hero_name',
        'hero_tagline',
        'site_title',
        'about_text',
        'email',
        'phone',
        'whatsapp',
        'address',
        'photo_path',
        'cv_url',
        'socials',
    ];

    protected $casts = [
        'socials' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->first() ?? new self();
    }
}
