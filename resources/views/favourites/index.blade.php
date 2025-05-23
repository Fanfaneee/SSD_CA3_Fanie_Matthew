@extends('layouts.app')
@section('title', 'Favourites')

@section('content')

<div class="bg-custom-purple text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Your favourite festivals !</h1>
</div>
<div class="container mx-auto mt-8">
    

    @if ($favorites->isEmpty())
        <p class="text-center text-gray-300">You have no favorite festivals yet.</p>
    @else
        <div class="grid grid-cols-3 gap-6">
            @foreach ($favorites as $festival)
                <div class="rounded-lg overflow-hidden shadow-lg bg-custom-background-dark">
                    <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-white text-xl font-bold mt-2">{{ $festival->name }}</h2>
                        <p class="text-gray-300">{{ $festival->location }}</p>
                        <p class="text-gray-300">{{ $festival->genre }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <!-- Bouton "View Details" -->
                            <a href="{{ route('festivals.show', $festival->id) }}" class="bg-custom-purple text-white px-4 py-2 rounded hover:bg-custom-purple-dark">
                                View Details
                            </a>

                            <!-- Remove from Favorites -->
                            <form action="{{ route('favorites.destroy', $festival->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection