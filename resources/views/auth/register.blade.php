@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 2rem auto; background: var(--secondary); padding: 2rem; border-radius: 8px;">
    <h2 style="margin-bottom: 1.5rem; text-align: center;">Register</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Phone</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label style="display:block; margin-bottom: 0.5rem; color:var(--gray);">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">Register</button>
    </form>
</div>
@endsection
