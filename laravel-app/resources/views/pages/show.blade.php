<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->meta_title ?? $page->title }}</title>
    <meta name="description" content="{{ $page->meta_description ?? $page->excerpt }}">
    <meta name="keywords" content="{{ $page->meta_keywords }}">
    <meta name="author" content="{{ $page->author->name }}">
    
    @if($page->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $page->featured_image) }}">
    @endif
    
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .content {
            line-height: 1.8;
        }
        .featured-image {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 8px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Ana Sayfaya Dön</a>
        
        <h1>{{ $page->title }}</h1>
        
        <div class="meta">
            <strong>Yazar:</strong> {{ $page->author->name }} | 
            <strong>Yayın Tarihi:</strong> {{ $page->published_at->format('d.m.Y H:i') }}
        </div>
        
        @if($page->featured_image)
            <img src="{{ asset('storage/' . $page->featured_image) }}" 
                 alt="{{ $page->title }}" 
                 class="featured-image">
        @endif
        
        @if($page->excerpt)
            <div class="excerpt">
                <p><em>{{ $page->excerpt }}</em></p>
            </div>
        @endif
        
        <div class="content">
            {!! $page->content !!}
        </div>
    </div>
</body>
</html>
