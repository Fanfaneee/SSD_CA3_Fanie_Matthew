@extends('layouts.app')

@section('content')
<div class="bg-custom-purple text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals in our list!</h1>
</div>

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Add a New Festival</h1>

    <form action="{{ route('festivals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-bold text-white">Festival Name</label>
            <input type="text" name="name" id="name" class="w-full border p-2" value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block font-bold text-white">Festival Image</label>
            <input type="file" name="image" id="image" class="w-full border p-2">
            @error('image')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="location" class="block font-bold text-white">Location</label>
            <input type="text" name="location" id="location" class="w-full border p-2" value="{{ old('location') }}" required>
            @error('location')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="genre" class="block font-bold text-white">Genre</label>
            <input type="text" name="genre" id="genre" class="w-full border p-2" value="{{ old('genre') }}" required>
            @error('genre')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="lineup" class="block font-bold text-white">Lineup (Artists)</label>
            <textarea name="lineup" id="lineup" class="w-full border p-2" required>{{ old('lineup') }}</textarea>
            @error('lineup')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block font-bold text-white">Price</label>
            <input type="number" name="price" id="price" class="w-full border p-2" value="{{ old('price') }}">
            @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="start_date" class="block font-bold text-white">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="w-full border p-2" value="{{ old('start_date') }}" required>
            @error('start_date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_date" class="block font-bold text-white">End Date</label>
            <input type="date" name="end_date" id="end_date" class="w-full border p-2" value="{{ old('end_date') }}" required>
            @error('end_date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Festival</button>
    </form>
</div>

@endsection