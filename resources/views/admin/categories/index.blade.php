@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
    <h2>Manage Categories</h2>
</div>

<div style="background: var(--secondary); padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
    <h3>Add New Category</h3>
    <form action="{{ route('admin.categories.store') }}" method="POST" style="display:flex; gap: 1rem; margin-top: 1rem;">
        @csrf
        <div class="form-group" style="flex:1; margin-bottom:0;">
            <input type="text" name="name" class="form-control" placeholder="Category Name" required>
        </div>
        <div class="form-group" style="flex:1; margin-bottom:0;">
            <select name="type" class="form-control" required>
                <option value="artist">Artist</option>
                <option value="album">Album</option>
                <option value="genre">Genre</option>
                <option value="year">Year</option>
                <option value="language">Language</option>
            </select>
        </div>
        <button type="submit" class="btn">Add Category</button>
    </form>
</div>

<div style="background: var(--secondary); padding: 1.5rem; border-radius: 8px;">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ ucfirst($category->type) }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
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
@endsection
