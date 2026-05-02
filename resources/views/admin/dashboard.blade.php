@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 2rem;">Admin Dashboard</h2>

<div class="grid">
    <div class="card" style="padding: 2rem; text-align: center;">
        <h3 style="font-size: 2rem; color: var(--primary);">{{ $stats['users'] }}</h3>
        <p>Total Users</p>
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="margin-top: 1rem;">Manage</a>
    </div>
    
    <div class="card" style="padding: 2rem; text-align: center;">
        <h3 style="font-size: 2rem; color: var(--primary);">{{ $stats['categories'] }}</h3>
        <p>Categories</p>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm" style="margin-top: 1rem;">Manage</a>
    </div>

    <div class="card" style="padding: 2rem; text-align: center;">
        <h3 style="font-size: 2rem; color: var(--primary);">{{ $stats['music'] }}</h3>
        <p>Music Tracks</p>
        <a href="{{ route('admin.media.index') }}" class="btn btn-sm" style="margin-top: 1rem;">Manage</a>
    </div>

    <div class="card" style="padding: 2rem; text-align: center;">
        <h3 style="font-size: 2rem; color: var(--primary);">{{ $stats['videos'] }}</h3>
        <p>Videos</p>
        <a href="{{ route('admin.media.index') }}" class="btn btn-sm" style="margin-top: 1rem;">Manage</a>
    </div>
</div>
@endsection
