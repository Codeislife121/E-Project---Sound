@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
    <h2>Manage Users</h2>
</div>

<div style="background: var(--secondary); padding: 1.5rem; border-radius: 8px;">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span style="padding: 3px 8px; border-radius: 12px; background: {{ $user->role === 'admin' ? 'var(--primary)' : 'var(--gray)' }}; color: white; font-size: 0.8rem;">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove user?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
