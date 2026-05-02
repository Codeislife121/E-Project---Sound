@extends('layouts.app')

@section('content')
<!-- Stunning Hero Section -->
<div style="position: relative; border-radius: 28px; overflow: hidden; margin-bottom: 4rem; background: var(--secondary); min-height: 480px; display: flex; align-items: center; box-shadow: 0 20px 50px rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.05);">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        <img src="{{ asset('images/hero.png') }}" style="width:100%; height:100%; object-fit: cover; opacity: 0.65; mix-blend-mode: screen; filter: contrast(1.1) saturate(1.3);">
        <div style="position: absolute; inset: 0; background: linear-gradient(100deg, var(--dark) 0%, rgba(10,10,16,0.85) 45%, transparent 100%);"></div>
    </div>
    
    <div style="position: relative; z-index: 2; padding: 5rem; max-width: 650px;">
        <span style="color:var(--primary); font-weight:800; letter-spacing:2px; text-transform:uppercase; font-size:0.9rem; margin-bottom:1rem; display:block;">Welcome to Sound Group</span>
        <h1 style="font-size: 4.2rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.8rem; letter-spacing:-1px;">
            Experience The <br><span style="color: var(--primary); text-shadow: 0 0 30px var(--primary-glow); position:relative;">Future <svg style="position:absolute; bottom:-10px; left:0; width:100%; height:15px; fill:var(--primary); opacity:0.5;" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0,5 Q50,15 100,5" stroke="var(--primary)" stroke-width="4" fill="transparent"/></svg></span> Of Entertainment
        </h1>
        <p style="color: #ccc; font-size: 1.25rem; margin-bottom: 2.5rem; line-height: 1.7; font-weight: 300;">
            Dive into an immersive world of the latest high-fidelity music, global artists, and stunning visual videos. Sound Group brings you closer to what you love.
        </p>
        <div style="display: flex; gap: 1.5rem;">
            <a href="{{ route('search') }}" class="btn" style="padding: 1rem 2.5rem; font-size: 1rem;">Explore Library</a>
            @guest
                <a href="{{ route('register') }}" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); box-shadow: none; padding: 1rem 2.5rem; font-size: 1rem; backdrop-filter:blur(10px);">Join For Free</a>
            @endguest
        </div>
    </div>
</div>

<!-- Section Header -->
<div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 2rem;">
    <h3 style="font-size: 2rem; font-weight: 800; letter-spacing: -0.5px;">Trending <span style="color:var(--primary);">Music</span> Drops</h3>
    <a href="{{ route('search', ['type' => 'music']) }}" style="color:var(--gray); text-decoration:none; font-weight:600; font-size:0.9rem; text-transform:uppercase; letter-spacing:1px; transition:color 0.3s;">View All Archive →</a>
</div>

<!-- Music Media Grid -->
<div class="grid" style="margin-bottom: 5rem;">
    @foreach($latestMusic as $item)
        <a href="{{ route('media.show', $item->id) }}" class="card">
            @if($item->created_at->diffInDays(now()) <= 7)
                <span class="badge-new">NEW</span>
            @endif
            <div class="img-wrapper">
                <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}">
            </div>
            <div class="card-body">
                <h4>{{ $item->title }}</h4>
                <p>{{ $item->categories->pluck('name')->join(', ') ?: 'Uncategorized' }}</p>
            </div>
        </a>
    @endforeach
    @if($latestMusic->isEmpty())
        <div style="grid-column: 1 / -1; background:var(--secondary); padding:3rem; text-align:center; border-radius:16px;">
            <h3 style="color:var(--gray);">No music available right now.</h3>
            <p style="color:var(--gray); margin-top:0.5rem;">Check back later or explore other sections.</p>
        </div>
    @endif
</div>

<!-- Section Header -->
<div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 2rem;">
    <h3 style="font-size: 2rem; font-weight: 800; letter-spacing: -0.5px;">Latest <span style="color:var(--primary);">Videos</span></h3>
    <a href="{{ route('search', ['type' => 'video']) }}" style="color:var(--gray); text-decoration:none; font-weight:600; font-size:0.9rem; text-transform:uppercase; letter-spacing:1px; transition:color 0.3s;">View All Arcade →</a>
</div>

<!-- Video Media Grid -->
<div class="grid" style="margin-bottom: 3rem;">
    @foreach($latestVideos as $item)
        <a href="{{ route('media.show', $item->id) }}" class="card">
            @if($item->created_at->diffInDays(now()) <= 7)
                <span class="badge-new">NEW</span>
            @endif
            <div class="img-wrapper">
                <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}">
            </div>
            <div class="card-body">
                <h4>{{ $item->title }}</h4>
                <p>{{ $item->categories->pluck('name')->join(', ') ?: 'Uncategorized' }}</p>
            </div>
        </a>
    @endforeach
    @if($latestVideos->isEmpty())
        <div style="grid-column: 1 / -1; background:var(--secondary); padding:3rem; text-align:center; border-radius:16px;">
            <h3 style="color:var(--gray);">No videos available right now.</h3>
            <p style="color:var(--gray); margin-top:0.5rem;">Check back later or explore other sections.</p>
        </div>
    @endif
</div>
@endsection
