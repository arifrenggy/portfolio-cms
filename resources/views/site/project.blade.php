<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $project->description }}">
    <title>{{ $project->title }} — {{ $settings->hero_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

<header class="navbar">
    <nav class="nav-inner">
        <a href="{{ url('/') }}" class="logo">{{ \Illuminate\Support\Str::of($settings->hero_name)->substr(0, 2)->upper() }}<span>.</span></a>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="btn btn-outline btn-sm">&larr; Kembali</a></li>
        </ul>
    </nav>
</header>

<section class="section" style="padding-top: 140px;">
    <h2 class="section-title reveal">{{ $project->title }}</h2>
    @if($project->tags)
        <div class="project-tags reveal" style="justify-content: center;">
            @foreach($project->tags as $tag)
                <span class="tag">{{ $tag }}</span>
            @endforeach
        </div>
    @endif
    <div class="about-grid">
        <div class="about-text reveal">
            <p>{{ $project->description }}</p>
            {!! $project->content !!}
        </div>
        @if($project->image_path)
            <div class="about-image reveal">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($project->image_path) }}" alt="{{ $project->title }}">
            </div>
        @endif
    </div>
    @if($project->link)
        <div class="cv-cta reveal">
            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn-primary">Kunjungi Proyek &rarr;</a>
        </div>
    @endif
</section>

<footer class="footer">
    <p>&copy; {{ date('Y') }} {{ $settings->hero_name }}. Semua hak dilindungi.</p>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
