<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings->hero_name }} — Portfolio pribadi: keahlian, proyek, dan kontak.">
    <title>{{ $settings->site_title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

{{-- Navigasi --}}
<header class="navbar">
    <nav class="nav-inner">
        <a href="#hero" class="logo">{{ strtolower(\Illuminate\Support\Str::of($settings->hero_name)->before(' ')->substr(0, 1)) }}{{ strtolower(\Illuminate\Support\Str::of($settings->hero_name)->afterLast(' ')->substr(0, 1)) }}<span>.dev</span></a>
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
    $firstName = \Illuminate\Support\Str::beforeLast($settings->hero_name, ' ');
    $lastName = \Illuminate\Support\Str::afterLast($settings->hero_name, ' ');
@endphp

@foreach($sections as $section)
    @php($sectionIndex++)

    @if($section->type === 'hero')
        <section id="hero" class="hero">
            <div class="hero-content reveal">
                <p class="hero-hello">{{ $settings->hero_greeting ?: 'Halo, saya' }}</p>
                <h1>{{ $firstName }} <span class="accent">{{ $lastName }}</span></h1>
                <p class="hero-tagline">{{ $settings->hero_tagline }}</p>
                <div class="hero-status">
                    <span class="dot"></span>
                    Open to work — tersedia untuk proyek & kolaborasi
                </div>
                <div class="hero-cta">
                    <a href="#projects" class="btn btn-primary">&gt; Lihat Proyek</a>
                    <a href="#contact" class="btn btn-outline">Hubungi Saya</a>
                </div>
            </div>

            <div class="terminal reveal" aria-hidden="true">
                <div class="terminal-bar">
                    <span class="t-dot"></span><span class="t-dot"></span><span class="t-dot"></span>
                    <span class="t-title">{{ strtolower(\Illuminate\Support\Str::of($settings->hero_name)->before(' ')) }}@portfolio: ~</span>
                </div>
                <div class="terminal-body">
                    <div><span class="cmd">whoami</span></div>
                    <div class="out">{{ $settings->hero_name }}</div>
                    <div><span class="cmd">cat <span class="str">role.txt</span></span></div>
                    <div class="out">{{ \Illuminate\Support\Str::limit($settings->hero_tagline, 48) }}</div>
                    @if($skills->isNotEmpty())
                        <div><span class="cmd">ls <span class="kw">~/skills</span></span></div>
                        <div class="out ok">{{ $skills->take(4)->pluck('title')->implode('  ') }}</div>
                    @endif
                    @if($settings->email)
                        <div><span class="cmd"><span class="fn">contact</span> --email</span></div>
                        <div class="out">{{ $settings->email }}</div>
                    @endif
                    <div><span class="cmd"></span><span class="cursor"></span></div>
                </div>
            </div>
        </section>
    @elseif($section->type === 'about')
        <section id="about" class="section">
            <h2 class="section-title reveal"><span class="sec-num">0{{ $sectionIndex }}.</span> {{ $section->title }}</h2>
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
            <h2 class="section-title reveal"><span class="sec-num">0{{ $sectionIndex }}.</span> {{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="skills-grid">
                @forelse($skills as $skill)
                    <div class="skill-card reveal">
                        @if($skill->icon)<div class="skill-icon">{{ $skill->icon }}</div>@endif
                        <h3>{{ $skill->title }}</h3>
                        @if($skill->description)<p>{{ $skill->description }}</p>@endif
                    </div>
                @empty
                    <p class="reveal">// Belum ada keahlian yang ditambahkan.</p>
                @endforelse
            </div>
        </section>
    @elseif($section->type === 'projects')
        <section id="projects" class="section">
            <h2 class="section-title reveal"><span class="sec-num">0{{ $sectionIndex }}.</span> {{ $section->title }}</h2>
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
                                <a href="{{ route('project.show', $project->slug) }}" class="btn btn-primary btn-sm">&gt; Detail</a>
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Demo &rarr;</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="reveal">// Belum ada proyek yang ditambahkan.</p>
                @endforelse
            </div>
        </section>
    @elseif($section->type === 'contact')
        <section id="contact" class="section section-alt">
            <h2 class="section-title reveal"><span class="sec-num">0{{ $sectionIndex }}.</span> {{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="contact-grid">
                <div class="contact-card reveal">
                    @if($settings->email)
                        <div class="contact-item"><strong>email</strong><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></div>
                    @endif
                    @if($settings->whatsapp)
                        <div class="contact-item"><strong>whatsapp</strong><a href="https://wa.me/{{ $settings->whatsapp }}" target="_blank" rel="noopener">{{ $settings->whatsapp }}</a></div>
                    @endif
                    @if($settings->address)
                        <div class="contact-item"><strong>lokasi</strong><span>{{ $settings->address }}</span></div>
                    @endif
                </div>
                @if($settings->socials)
                    <div class="socials reveal">
                        @foreach($settings->socials as $social)
                            <a href="{{ $social['url'] ?? '' }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">{{ ($social['platform'] ?? 'Link') }} &rarr;</a>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($settings->cv_url)
                <div class="cv-cta reveal">
                    <a href="{{ $settings->cv_url }}" target="_blank" rel="noopener" class="btn btn-primary">&gt; Unduh CV</a>
                </div>
            @endif
        </section>
    @else
        <section id="{{ \Illuminate\Support\Str::slug($section->name) }}" class="section {{ $sectionIndex % 2 === 0 ? 'section-alt' : '' }}">
            <h2 class="section-title reveal"><span class="sec-num">0{{ $sectionIndex }}.</span> {{ $section->title }}</h2>
            @if($section->subtitle)<p class="section-subtitle reveal">{{ $section->subtitle }}</p>@endif
            <div class="about-text reveal">
                {!! $section->content !!}
            </div>
        </section>
    @endif
@endforeach

{{-- Footer --}}
<footer class="footer">
    <p>&copy; <span id="year">{{ date('Y') }}</span> {{ $settings->hero_name }} — dibuat dengan <span class="heart">Laravel</span> + <span class="heart">Filament</span> <span class="heart">&lt;3</span></p>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
