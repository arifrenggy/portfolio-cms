<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings->hero_name }} — Portfolio pribadi: keahlian, proyek, dan kontak.">
    <title>{{ $settings->site_title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

{{-- Navigasi --}}
<header class="navbar">
    <nav class="nav-inner">
        <a href="#hero" class="logo">{{ \Illuminate\Support\Str::of($settings->hero_name)->substr(0, 2)->upper() }}<span>.</span></a>
        <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <ul class="nav-links" id="navLinks">
            @foreach($menuItems as $item)
                <li><a href="{{ $item->url }}" @if($item->sort_order >= 4 && str_starts_with($item->url, '#')) class="btn btn-outline btn-sm" @endif>{{ $item->label }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>

{{-- Section dinamis --}}
@php
    $sectionIndex = 0;
@endphp

@foreach($sections as $section)
    @php($sectionIndex++)

    @if($section->type === 'hero')
        <section id="hero" class="hero">
            <div class="hero-content reveal">
                <p class="hero-hello">{{ $settings->hero_greeting }}</p>
                <h1>{{ \Illuminate\Support\Str::beforeLast($settings->hero_name, ' ') }} <span>{{ \Illuminate\Support\Str::afterLast($settings->hero_name, ' ') }}</span></h1>
                <p class="hero-tagline">{{ $settings->hero_tagline }}</p>
                <div class="hero-cta">
                    <a href="#projects" class="btn btn-primary">Lihat Proyek</a>
                    <a href="#contact" class="btn btn-outline">Hubungi Saya</a>
                </div>
            </div>
            @if($settings->photo_path)
                <div class="hero-photo reveal">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($settings->photo_path) }}" alt="Foto {{ $settings->hero_name }}">
                </div>
            @endif
            <div class="hero-blob" aria-hidden="true"></div>
        </section>
    @elseif($section->type === 'about')
        <section id="about" class="section">
            <h2 class="section-title reveal">{{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="about-grid">
                <div class="about-text reveal">
                    {!! $settings->about_text ?: $section->content !!}
                </div>
                @if($section->image_path)
                    <div class="about-image reveal">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($section->image_path) }}" alt="{{ $section->title }}">
                    </div>
                @endif
            </div>
        </section>
    @elseif($section->type === 'skills')
        <section id="skills" class="section section-alt">
            <h2 class="section-title reveal">{{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="skills-grid">
                @forelse($skills as $skill)
                    <div class="skill-card reveal">
                        @if($skill->icon)<div class="skill-icon">{{ $skill->icon }}</div>@endif
                        <h3>{{ $skill->title }}</h3>
                        @if($skill->description)<p>{{ $skill->description }}</p>@endif
                    </div>
                @empty
                    <p class="reveal">Belum ada keahlian yang ditambahkan.</p>
                @endforelse
            </div>
        </section>
    @elseif($section->type === 'projects')
        <section id="projects" class="section">
            <h2 class="section-title reveal">{{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="projects-grid">
                @forelse($projects as $project)
                    <article class="project-card reveal">
                        @if($project->image_path)
                            <div class="project-image">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($project->image_path) }}" alt="{{ $project->title }}">
                            </div>
                        @endif
                        <div class="project-body">
                            <h3>{{ $project->title }}</h3>
                            @if($project->tags)
                                <div class="project-tags">
                                    @foreach($project->tags as $tag)
                                        <span class="tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <p>{{ $project->description }}</p>
                            <div class="project-links">
                                <a href="{{ route('project.show', $project->slug) }}" class="btn btn-primary btn-sm">Detail</a>
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Kunjungi &rarr;</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="reveal">Belum ada proyek yang ditambahkan.</p>
                @endforelse
            </div>
        </section>
    @elseif($section->type === 'contact')
        <section id="contact" class="section section-alt">
            <h2 class="section-title reveal">{{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="contact-grid">
                <div class="contact-card reveal">
                    @if($settings->email)
                        <div class="contact-item"><strong>Email</strong><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></div>
                    @endif
                    @if($settings->whatsapp)
                        <div class="contact-item"><strong>WhatsApp</strong><a href="https://wa.me/{{ $settings->whatsapp }}" target="_blank" rel="noopener">Chat via WhatsApp</a></div>
                    @endif
                    @if($settings->address)
                        <div class="contact-item"><strong>Lokasi</strong><span>{{ $settings->address }}</span></div>
                    @endif
                </div>
                @if($settings->socials)
                    <div class="socials reveal">
                        @foreach($settings->socials as $social)
                            <a href="{{ $social['url'] ?? '' }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">{{ $social['platform'] ?? 'Link' }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($settings->cv_url)
                <div class="cv-cta reveal">
                    <a href="{{ $settings->cv_url }}" target="_blank" rel="noopener" class="btn btn-primary">Unduh CV Saya</a>
                </div>
            @endif
        </section>
    @else
        <section id="{{ \Illuminate\Support\Str::slug($section->name) }}" class="section {{ $sectionIndex % 2 === 0 ? 'section-alt' : '' }}">
            <h2 class="section-title reveal">{{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="about-text reveal">
                {!! $section->content !!}
            </div>
        </section>
    @endif
@endforeach

{{-- Footer --}}
<footer class="footer">
    <p>&copy; {{ date('Y') }} {{ $settings->hero_name }}. Semua hak dilindungi.</p>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
