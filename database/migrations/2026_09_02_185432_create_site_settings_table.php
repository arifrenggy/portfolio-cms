<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_greeting')->default('Halo, saya 👋');
            $table->string('hero_name')->default('Kurniawan A. Renggy');
            $table->string('hero_tagline')->default('Saya suka membangun hal-hal yang bermanfaat.');
            $table->string('site_title')->default('Kurniawan A. Renggy — Portfolio');
            $table->text('about_text')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('cv_url')->nullable();
            $table->json('socials')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
