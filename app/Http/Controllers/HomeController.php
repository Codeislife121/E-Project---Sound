<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $latestMusic = Media::where('type', 'music')->latest()->take(5)->get();
        $latestVideos = Media::where('type', 'video')->latest()->take(5)->get();
        $categories = Category::all();
        return view('home', compact('latestMusic', 'latestVideos', 'categories'));
    }

    public function show($id)
    {
        $media = Media::with(['categories', 'reviews.user', 'ratings'])->findOrFail($id);
        $averageRating = $media->averageRating();
        return view('media.show', compact('media', 'averageRating'));
    }

    public function search(Request $request)
    {
        $query = Media::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        $results = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('search', compact('results', 'categories'));
    }
}
