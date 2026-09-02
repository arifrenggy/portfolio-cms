<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $project->description }}">
    <title>{{ $project->title }} — {{ $settings->hero_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

<header class="navbar">
    <nav class="nav-inner">
        <a href="{{ url('/') }}" class="logo">{{ strtolower(\Illuminate\Support\Str::of($settings->hero_name)->before(' ')->substr(0, 1)) }}{{ strtolower(\Illuminate\Support\Str::of($settings->hero_name)->afterLast(' ')->substr(0, 1)) }}<span>.dev</span></a>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="btn btn-outline btn-sm">&larr; Kembali</a></li>
        </ul>
    </nav>
</header>

<div class="breadcrumb">
    <a href="{{ url('/') }}">~</a><span class="sep">/</span><span>proyek</span><span class="sep">/</span><span>{{ $project->slug }}</span>
</div>

<section class="detail-content">
    <h1 class="detail-title reveal">{{ $project->title }}</h1>
    @if($project->tags)
        <div class="project-tags reveal">
            @foreach($project->tags as $tag)
                <span class="tag">{{ $tag }}</span>
            @endforeach
        </div>
    @endif
    @if($project->image_path)
        <div class="detail-image reveal">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($project->image_path) }}" alt="{{ $project->title }}">
        </div>
    @endif
    <div class="detail-text reveal">
        <p>{{ $project->description }}</p>
        {!! $project->content !!}
    </div>
    @if($project->link)
        <div class="cv-cta reveal">
            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn-primary">&gt; Kunjungi Proyek</a>
        </div>
    @endif
</section>

<footer class="footer">
    <p>&copy; <span id="year">{{ date('Y') }}</span> {{ $settings->hero_name }} — dibuat dengan <span class="heart">Laravel</span> + <span class="heart">Filament</span> <span class="heart">&lt;3</span></p>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
