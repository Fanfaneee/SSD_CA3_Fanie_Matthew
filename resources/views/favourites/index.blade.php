@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">My Favorite Festivals</h1>

    @if ($favorites->isEmpty())
        <p class="text-gray-300">You have no favorite festivals yet.</p>
    @else
        <div class="grid grid-cols-3 gap-6">
            @foreach ($favorites as $festival)
                <div class="border border-gray-700 rounded-lg overflow-hidden shadow-lg bg-gray-800">
                    <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-white text-xl font-bold mt-2">{{ $festival->name }}</h2>
                        <p class="text-gray-300">{{ $festival->location }}</p>
                        <p class="text-gray-300">{{ $festival->genre }}</p>
                        <a href="{{ route('festivals.show', $festival->id) }}" class="text-blue-400 underline hover:text-blue-600">View Details</a>

                        <!-- Remove from Favorites -->
                        <form action="{{ route('favorites.destroy', $festival->id) }}" method="POST" class="inline-block mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Remove from Favorites
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection