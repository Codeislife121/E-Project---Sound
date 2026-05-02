<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::with('categories')->get();
        $categories = Category::all();
        return view('admin.media.index', compact('media', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:music,video',
            'file' => 'nullable|required_if:type,music|file|mimes:mp3,mp4,wav,avi|max:500000',
            'youtube_url' => 'nullable|required_if:type,video|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('media_files', 'public');
        }
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        $media = Media::create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $filePath,
            'youtube_url' => $request->youtube_url,
            'thumbnail_path' => $thumbnailPath,
            'description' => $request->description,
        ]);

        if ($request->has('categories')) {
            $media->categories()->sync($request->categories);
        }

        return back()->with('success', 'Media created successfully');
    }

    public function destroy(Media $medium)
    {
        Storage::disk('public')->delete([$medium->file_path, $medium->thumbnail_path]);
        $medium->delete();
        return back()->with('success', 'Media deleted successfully');
    }
}
