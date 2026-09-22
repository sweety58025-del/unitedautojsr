@extends('frontend.partials.master')

@section('title', 'United Auto Workshop Gallery | Jamshedpur')
@section('meta_description', 'View United Auto vehicle repair, detailing, paint protection, and workshop project photos from Jamshedpur.')

@section('content')
@php
    $galleryItems = $gallery->take(4);
    $featuredImage = $gallery->first();
@endphp

<style>
    .google-results-shell {
        background: #1f2329;
        min-height: calc(100vh - 140px);
        color: #e5e7eb;
        padding: 40px 0 80px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .google-results-container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    .google-topbar {
        display: flex;
        align-items: center;
        gap: 20px;
        background: rgba(92, 96, 104, 0.65);
        border-radius: 30px;
        padding: 14px 20px 14px 18px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        max-width: 1000px;
        margin: 0 auto 18px;
    }

    .google-logo {
        font-size: clamp(2rem, 2vw, 3rem);
        font-weight: 700;
        letter-spacing: -0.06em;
        line-height: 1;
        color: #f3f4f6;
        white-space: nowrap;
    }

    .google-logo .g1 { color: #4285f4; }
    .google-logo .g2 { color: #ea4335; }
    .google-logo .g3 { color: #fbbc05; }
    .google-logo .g4 { color: #4285f4; }
    .google-logo .g5 { color: #34a853; }
    .google-logo .g6 { color: #ea4335; }

    .google-search {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: rgba(255,255,255,0.04);
        border-radius: 999px;
        padding: 10px 16px 10px 20px;
        min-height: 44px;
        border: 1px solid rgba(255,255,255,0.05);
    }

    .google-search input {
        flex: 1;
        border: 0;
        background: transparent;
        color: #f5f5f5;
        font-size: 1.1rem;
        outline: none;
    }

    .google-search input::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .search-actions {
        display: flex;
        align-items: center;
        gap: 16px;
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
    }

    .google-tabs {
        display: flex;
        align-items: center;
        gap: 24px;
        max-width: 1000px;
        margin: 0 auto;
        padding: 8px 0 18px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .google-tabs a {
        color: inherit;
        text-decoration: none;
        padding-bottom: 10px;
        border-bottom: 2px solid transparent;
    }

    .google-tabs a.active {
        color: #e5e7eb;
        border-color: #e5e7eb;
    }

    .google-results-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.8fr) minmax(220px, 360px);
        gap: 32px;
        max-width: 1000px;
        margin: 28px auto 0;
    }

    .result-list {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .result-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }

    .result-favicon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff;
        background: linear-gradient(135deg, #111827, #374151);
        border: 2px solid rgba(255,255,255,0.1);
        flex-shrink: 0;
    }

    .result-content {
        flex: 1;
        min-width: 0;
    }

    .result-site {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        color: rgba(255,255,255,0.75);
        margin-bottom: 6px;
    }

    .result-site .site-name {
        font-weight: 600;
        color: #e5e7eb;
    }

    .result-title {
        color: #bbdefb;
        text-decoration: none;
        font-size: clamp(1.6rem, 2vw, 2.4rem);
        line-height: 1.25;
        font-weight: 500;
        letter-spacing: -0.04em;
        display: inline-block;
        margin-bottom: 8px;
    }

    .result-title:hover {
        text-decoration: underline;
    }

    .result-snippet {
        color: rgba(255,255,255,0.8);
        font-size: 1.06rem;
        line-height: 1.6;
        max-width: 680px;
    }

    .result-snippet .read-more {
        color: #8ab4f8;
        text-decoration: none;
    }

    .result-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
        color: rgba(255,255,255,0.7);
        font-size: 0.98rem;
    }

    .stars {
        color: #fbbf24;
        letter-spacing: 0.05em;
    }

    .side-panel {
        margin-top: 30px;
    }

    .side-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    }

    .side-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        display: block;
        background: #e5e7eb;
    }

    .side-body {
        padding: 18px 18px 14px;
    }

    .side-heading {
        font-size: 2rem;
        color: #f3f4f6;
        margin: 0 0 10px;
        font-weight: 500;
    }

    .side-meta {
        color: rgba(255,255,255,0.72);
        font-size: 1rem;
        margin-bottom: 12px;
    }

    .side-actions {
        display: flex;
        gap: 12px;
        margin-top: 18px;
    }

    .side-button {
        flex: 1;
        min-height: 46px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,0.18);
        background: rgba(255,255,255,0.03);
        color: #f3f4f6;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .side-address {
        margin-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.08);
        padding-top: 18px;
        color: rgba(255,255,255,0.8);
        line-height: 1.6;
        font-size: 0.96rem;
    }

    @media (max-width: 900px) {
        .google-results-layout {
            grid-template-columns: 1fr;
        }

        .side-panel {
            order: -1;
            margin-top: 0;
        }
    }

    @media (max-width: 640px) {
        .google-topbar {
            gap: 12px;
            padding: 12px 12px 12px 14px;
        }

        .google-logo {
            display: none;
        }

        .google-tabs {
            gap: 12px;
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 12px;
        }

        .result-item {
            gap: 10px;
        }
    }
</style>

<div class="google-results-shell">
    <div class="google-results-container">
        <div class="google-topbar" aria-label="Search box">
            <div class="google-logo" aria-label="Google">
                <span class="g1">G</span><span class="g2">o</span><span class="g3">o</span><span class="g4">g</span><span class="g5">l</span><span class="g6">e</span>
            </div>
            <div class="google-search">
                <input type="text" value="united auto jsr" aria-label="Search United Auto Jamshedpur" readonly>
                <div class="search-actions" aria-hidden="true">
                    <span>✕</span>
                    <span>🎙</span>
                    <span>⌕</span>
                </div>
            </div>
        </div>

        <nav class="google-tabs" aria-label="Search filters">
            <a href="#" class="active">All</a>
            <a href="#">Images</a>
            <a href="#">Videos</a>
            <a href="#">Maps</a>
            <a href="#">News</a>
            <a href="#">More</a>
        </nav>

        <div class="google-results-layout">
            <div class="result-list">
                @foreach($galleryItems as $item)
                    <article class="result-item">
                        <div class="result-favicon" aria-hidden="true">{{ strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $item->name ?: 'UA'), 0, 2) ?: 'UA') }}</div>
                        <div class="result-content">
                            <div class="result-site">
                                <span class="site-name">unitedautojsr.in</span>
                                <span>›</span>
                            </div>
                            <a class="result-title" href="{{ route('gallery') }}">{{ $item->name ?: 'United Auto Workshop Gallery' }}</a>
                            <div class="result-snippet">
                                {{ $item->name ?: 'United Auto workshop gallery' }} showcases repairs, detailing, paint protection, and workshop transformations from Jamshedpur.
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <aside class="side-panel">
                <div class="side-card">
                    @if($featuredImage && $featuredImage->image)
                        <img class="side-image" src="{{ asset($featuredImage->image) }}" alt="{{ $featuredImage->name }}">
                    @else
                        <img class="side-image" src="{{ asset('front/assets/img/default-workshop.jpg') }}" alt="United Auto workshop">
                    @endif
                    <div class="side-body">
                        <h2 class="side-heading">United Auto</h2>
                        <div class="side-meta">4.2 ★★★★★ 77 Google reviews</div>
                        <div class="side-actions">
                            <a class="side-button" href="https://www.google.com/maps/search/?api=1&query=United+Auto+Jamshedpur" target="_blank" rel="noopener noreferrer">Directions</a>
                            <a class="side-button" href="tel:+919876543210">Call</a>
                        </div>
                        <div class="side-address">
                            Address: UNITED AUTO<br>
                            GATE MILLS AND GODOWN ROAD<br>
                            Jamshedpur, Jharkhand
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@endsection