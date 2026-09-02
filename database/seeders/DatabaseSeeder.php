<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Project;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Admin user (GANTI email & password setelah login pertama!) ──
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        // ── Site settings ──
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_title' => 'Kurniawan A. Renggy — Portfolio',
                'hero_greeting' => 'Halo, saya 👋',
                'hero_name' => 'Kurniawan A. Renggy',
                'hero_tagline' => 'Saya suka membangun hal-hal yang bermanfaat.',
                'about_text' => '<p>Tulis cerita tentang diri Anda di sini. Anda bisa mengubah seluruh teks ini melalui panel admin Filament — masuk ke <strong>Pengaturan Situs</strong> dan ubah sesuai keinginan.</p>',
                'email' => 'halo@contoh.com',
                'whatsapp' => '6281234567890',
                'address' => 'Indonesia',
                'socials' => [
                    ['platform' => 'GitHub', 'url' => 'https://github.com/username'],
                    ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/username'],
                ],
            ]
        );

        // ── Sections ──
        $sections = [
            ['name' => 'Hero', 'type' => 'hero', 'title' => null, 'subtitle' => null, 'sort_order' => 1],
            ['name' => 'Tentang Saya', 'type' => 'about', 'title' => 'Tentang Saya', 'subtitle' => 'Sedikit tentang siapa saya', 'sort_order' => 2],
            ['name' => 'Keahlian', 'type' => 'skills', 'title' => 'Keahlian', 'subtitle' => 'Apa yang bisa saya lakukan', 'sort_order' => 3],
            ['name' => 'Proyek', 'type' => 'projects', 'title' => 'Proyek Pilihan', 'subtitle' => 'Karya yang pernah saya buat', 'sort_order' => 4],
            ['name' => 'Kontak', 'type' => 'contact', 'title' => 'Hubungi Saya', 'subtitle' => 'Mari bekerja sama', 'sort_order' => 5],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['name' => $section['name']],
                $section + ['is_visible' => true]
            );
        }

        // ── Skills ──
        $skills = [
            ['title' => 'Web Development', 'icon' => '💻', 'description' => 'Membangun website modern dan responsif.', 'sort_order' => 1],
            ['title' => 'UI/UX Design', 'icon' => '🎨', 'description' => 'Mendesain antarmuka yang intuitif dan menarik.', 'sort_order' => 2],
            ['title' => 'Backend Development', 'icon' => '⚙️', 'description' => 'API, database, dan logika server.', 'sort_order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['title' => $skill['title']], $skill + ['is_visible' => true]);
        }

        // ── Projects ──
        $projects = [
            [
                'title' => 'Proyek Contoh Satu',
                'description' => 'Deskripsi singkat proyek pertama Anda.',
                'link' => 'https://example.com',
                'tags' => ['Laravel', 'Filament'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Proyek Contoh Dua',
                'description' => 'Deskripsi singkat proyek kedua Anda.',
                'link' => 'https://example.com',
                'tags' => ['JavaScript', 'UI/UX'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Proyek Contoh Tiga',
                'description' => 'Deskripsi singkat proyek ketiga Anda.',
                'link' => 'https://example.com',
                'tags' => ['Mobile', 'Design'],
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project + ['is_visible' => true]
            );
        }

        // ── Menu items ──
        $menuItems = [
            ['label' => 'Tentang', 'url' => '#about', 'sort_order' => 1],
            ['label' => 'Keahlian', 'url' => '#skills', 'sort_order' => 2],
            ['label' => 'Proyek', 'url' => '#projects', 'sort_order' => 3],
            ['label' => 'Kontak', 'url' => '#contact', 'sort_order' => 4],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(['label' => $item['label']], $item + ['is_visible' => true]);
        }
    }
}
