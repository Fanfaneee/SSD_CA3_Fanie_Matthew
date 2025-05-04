@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="name" class="block text-gray-300">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-300">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update User
        </button>
    </form>
</div>
@endsection