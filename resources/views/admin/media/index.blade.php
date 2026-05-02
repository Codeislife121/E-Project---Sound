@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
    <h2>Manage Media</h2>
</div>

<div style="background: var(--secondary); padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
    <h3>Add New Media</h3>
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 1rem;">
        @csrf
        <div class="form-group">
            <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        
        <div style="display:flex; gap: 1rem; margin-bottom: 1rem;">
            <div class="form-group" style="flex:1;">
                <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Type</label>
                <select name="type" class="form-control" required>
                    <option value="music">Music</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="form-group" style="flex:1;">
                <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Categories (Hold Ctrl/Cmd to select multiple)</label>
                <select name="categories[]" class="form-control" multiple style="height: 100px;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ ucfirst($cat->type) }}: {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:flex; gap: 1rem; margin-bottom: 1rem;">
            <div class="form-group" style="flex:1;" id="file-input-group">
                <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Media File (mp3, wav)</label>
                <input type="file" name="file" id="media-file-input" class="form-control" required style="padding:0.4rem;">
            </div>
            <div class="form-group" style="flex:1; display:none;" id="youtube-input-group">
                <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">YouTube Embed URL (or regular URL)</label>
                <input type="text" name="youtube_url" id="youtube-url-input" class="form-control" placeholder="https://www.youtube.com/watch?v=... or embed code">
            </div>
            <div class="form-group" style="flex:1;">
                <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Thumbnail Image (jpg, png)</label>
                <input type="file" name="thumbnail" class="form-control" required style="padding:0.4rem;">
            </div>
        </div>

        <div class="form-group">
            <label style="display:block; margin-bottom:0.5rem; color:var(--gray);">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn">Upload Media</button>
    </form>
</div>

<div style="background: var(--secondary); padding: 1.5rem; border-radius: 8px;">
    <table>
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Title & Type</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($media as $item)
            <tr>
                <td><img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="" style="width:60px; height:60px; object-fit:cover; border-radius:4px;"></td>
                <td>
                    <strong>{{ $item->title }}</strong><br>
                    <span style="color:var(--gray); font-size:0.8rem;">{{ ucfirst($item->type) }}</span>
                </td>
                <td>{{ $item->categories->pluck('name')->join(', ') }}</td>
                <td>
                    <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this media? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.querySelector('select[name="type"]');
        const fileGroup = document.getElementById('file-input-group');
        const fileInput = document.getElementById('media-file-input');
        const youtubeGroup = document.getElementById('youtube-input-group');
        const youtubeInput = document.getElementById('youtube-url-input');

        function toggleInputs() {
            if (typeSelect.value === 'video') {
                fileGroup.style.display = 'none';
                fileInput.required = false;
                youtubeGroup.style.display = 'block';
                youtubeInput.required = true;
            } else {
                fileGroup.style.display = 'block';
                fileInput.required = true;
                youtubeGroup.style.display = 'none';
                youtubeInput.required = false;
            }
        }

        typeSelect.addEventListener('change', toggleInputs);
        toggleInputs(); // Run on load
    });
</script>
@endsection
