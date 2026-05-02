@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 2rem auto; background: var(--secondary); padding: 2rem; border-radius: 8px;">
    <h2 style="margin-bottom: 1.5rem; text-align: center;">Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">Login</button>
    </form>
</div>
@endsection
