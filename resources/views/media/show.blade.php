@extends('layouts.app')

@section('content')
<div style="background: var(--secondary); padding: 2rem; border-radius: 8px;">
    <div style="display:flex; gap: 2rem; flex-wrap: wrap;">
        <img src="{{ asset('storage/' . $media->thumbnail_path) }}" alt="{{ $media->title }}" style="width:300px; height:300px; object-fit:cover; border-radius:8px;">
        <div style="flex: 1; min-width:300px;">
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem; color:var(--primary);">{{ $media->title }}</h2>
            <p style="margin-bottom: 1rem;"><strong style="color:var(--gray);">Type:</strong> {{ ucfirst($media->type) }}</p>
            
            <p style="margin-bottom: 1rem;"><strong style="color:var(--gray);">Categories:</strong> 
                {{ $media->categories->pluck('name')->join(', ') }}
            </p>
            
            <p style="margin-bottom: 1rem;"><strong style="color:var(--gray);">Average Rating:</strong> 
                <span style="font-size: 1.2rem; font-weight:bold; color: gold;">★ {{ number_format($averageRating, 1) }}/5</span>
            </p>

            <div style="margin-bottom: 2rem; color: #ddd; line-height: 1.6;">
                {{ $media->description ?? 'No description available.' }}
            </div>

            <div style="background: var(--dark); padding: 1rem; border-radius: 8px;">
                @if($media->type === 'video')
                    @php
                        $embedUrl = $media->youtube_url;
                        $isIframe = strpos($embedUrl, '<iframe') !== false;
                        if (!$isIframe && $embedUrl) {
                            if (strpos($embedUrl, 'watch?v=') !== false) {
                                $embedUrl = str_replace('watch?v=', 'embed/', $embedUrl);
                                $embedUrl = explode('&', $embedUrl)[0];
                            } elseif (strpos($embedUrl, 'youtu.be/') !== false) {
                                $embedUrl = str_replace('youtu.be/', 'youtube.com/embed/', $embedUrl);
                                $embedUrl = explode('?', $embedUrl)[0];
                            }
                        }
                    @endphp
                    @if($isIframe)
                        <div style="width:100%; border-radius:4px; overflow:hidden;">
                            {!! $media->youtube_url !!}
                        </div>
                    @elseif($embedUrl)
                        <iframe width="100%" height="400" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius:4px;"></iframe>
                    @else
                        <div class="alert alert-warning">No video URL provided.</div>
                    @endif
                @else
                    <audio controls style="width: 100%;">
                        <source src="{{ asset('storage/' . $media->file_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 3rem;">
    <h3>Ratings & Reviews</h3>
    <hr style="border:0; border-top: 1px solid var(--secondary); margin: 1rem 0;">

    @auth
        <div style="margin-bottom: 2rem; background: var(--secondary); padding: 1.5rem; border-radius: 8px;">
            <h4>Add Your Rating</h4>
            <form action="{{ route('rating.store', $media->id) }}" method="POST" style="margin-top: 0.5rem; display:flex; gap:10px;">
                @csrf
                <select name="rating" class="form-control" style="width:auto;" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
                <button type="submit" class="btn">Rate</button>
            </form>

            <h4 style="margin-top: 1.5rem;">Write a Review</h4>
            <form action="{{ route('review.store', $media->id) }}" method="POST" style="margin-top: 0.5rem;">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="4" placeholder="Share your thoughts..." required></textarea>
                </div>
                <button type="submit" class="btn">Submit Review</button>
            </form>
        </div>
    @else
        <div class="alert" style="background:#282838; border: 1px solid var(--gray);">
            Please <a href="{{ route('login') }}" style="color:var(--primary); font-weight:bold;">login</a> to submit a rating and review.
        </div>
    @endauth

    <div style="margin-top: 2rem;">
        @foreach($media->reviews as $review)
            <div style="background: var(--secondary); padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                    <strong style="color:var(--primary);">{{ $review->user->name }}</strong>
                    <span style="color:var(--gray); font-size:0.8rem;">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                <p style="line-height:1.5;">{{ $review->content }}</p>
            </div>
        @endforeach
        @if($media->reviews->isEmpty())
            <p style="color:var(--gray)">No reviews yet. Be the first!</p>
        @endif
    </div>
</div>
@endsection
