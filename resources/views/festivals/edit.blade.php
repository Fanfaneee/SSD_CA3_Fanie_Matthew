@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Edit Festival</h1>

    <form action="{{ route('festivals.update', $festival->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-gray-300">Name</label>
            <input type="text" name="name" id="name" value="{{ $festival->name }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-300">Location</label>
            <input type="text" name="location" id="location" value="{{ $festival->location }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="latitude" class="block text-gray-300">Latitude</label>
            <input type="text" name="latitude" id="latitude" value="{{ $festival->latitude }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="longitude" class="block text-gray-300">Longitude</label>
            <input type="text" name="longitude" id="longitude" value="{{ $festival->longitude }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="genre" class="block text-gray-300">Genre</label>
            <input type="text" name="genre" id="genre" value="{{ $festival->genre }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="lineup" class="block text-gray-300">Lineup</label>
            <textarea name="lineup" id="lineup" rows="4" class="w-full p-2 rounded bg-gray-700 text-white" required>{{ $festival->lineup }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-300">Price</label>
            <input type="number" name="price" id="price" value="{{ $festival->price }}" class="w-full p-2 rounded bg-gray-700 text-white">
        </div>

        <div class="mb-4">
            <label for="start_date" class="block text-gray-300">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $festival->start_date }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="end_date" class="block text-gray-300">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $festival->end_date }}" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-300">Image</label>
            <input type="file" name="image" id="image" class="w-full p-2 rounded bg-gray-700 text-white">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update Festival
        </button>
    </form>
</div>
@endsection