@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 1.5rem;">Search Results</h2>

<form action="{{ route('search') }}" method="GET" style="display:flex; gap: 1rem; margin-bottom: 2rem; background: var(--secondary); padding: 1rem; border-radius: 8px;">
    <input type="text" name="title" placeholder="Search by title" class="form-control" value="{{ request('title') }}">
    <select name="category_id" class="form-control">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                {{ ucfirst($cat->type) }}: {{ $cat->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn">Filter</button>
</form>

<div class="grid">
    @foreach($results as $item)
        <a href="{{ route('media.show', $item->id) }}" class="card">
            @if($item->created_at->diffInDays(now()) <= 7)
                <span class="badge-new">NEW</span>
            @endif
            <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}">
            <div class="card-body">
                <h4>{{ $item->title }}</h4>
                <p>{{ ucfirst($item->type) }}</p>
            </div>
        </a>
    @endforeach
</div>

@if($results->isEmpty())
    <p style="color:var(--gray)">No results found matching your criteria.</p>
@endif

<div style="margin-top: 2rem; display:flex;">
    {{ $results->links() }}
</div>
<style>
    .pagination { display: flex; list-style: none; gap:0.5rem; margin:auto; }
    .pagination li { display:inline-block; }
    .pagination li a, .pagination li span { padding: 0.5rem 1rem; background:var(--secondary); border-radius:4px; color:var(--light); text-decoration:none; }
    .pagination li.active span { background:var(--primary); }
</style>
@endsection
