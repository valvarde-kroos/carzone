@extends('layout.main')
@section('hyasabicontentauncha')
<!-- SUCCESS MESSAGE -->
@if (session('success'))
    <div class="success-banner">
        <p>{{ session('success') }}</p>
    </div>
@endif

<!-- HERO SECTION -->
<section class="modern-hero">
    <div class="hero-container-centered">
        <div class="hero-text-centered">
            <h1>Where Every Note<br>Tells a Nepali Story</h1>
            <p>Mastery isn't always about talent. It's about practice. Consistent practice builds skill. Greatness will come.</p>
            
            <!-- SEARCH BAR -->
            <div class="search-container">
                <form class="search-form" action="/search" method="GET">
                    <div class="search-input-wrapper">
                        <input type="text" name="query" placeholder="Find your traditional instrument..." class="search-input">
                        <button type="submit" class="search-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="hero-actions">
                <a href="/category" class="explore-btn">Explore Now →</a>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="features">
    <div class="features-container">
        <div class="feature-card">
            <div class="feature-icon">🏎️</div>
            <h3>Premium Cars</h3>
            <p>Discover the latest car models and reviews</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Fast Performance</h3>
            <p>Experience lightning-fast browsing and updates</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <h3>Precision Focus</h3>
            <p>Get exactly what you're looking for</p>
        </div>
    </div>
</section>
@endsection
