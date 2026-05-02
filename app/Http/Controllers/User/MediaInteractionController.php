<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Rating;

class MediaInteractionController extends Controller
{
    public function storeReview(Request $request, $media_id)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        Review::create([
            'user_id' => auth()->id(),
            'media_id' => $media_id,
            'content' => $request->content
        ]);
        return back()->with('success', 'Review added successfully!');
    }

    public function storeRating(Request $request, $media_id)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);
        Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'media_id' => $media_id],
            ['rating' => $request->rating]
        );
        return back()->with('success', 'Rating submitted successfully!');
    }
}
