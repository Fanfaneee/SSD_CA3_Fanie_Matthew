@extends('layouts.app')

@section('content')

<div class="bg-custom-purple text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals in our list!</h1>
</div>

<div class="container mx-auto mt-4">
    <!-- Bouton pour aller à la page de création -->
    <div class="text-right mb-4">
        @if (auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('festivals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add a New Festival
        </a>
        @endif
        
    </div>

    <div class="grid grid-cols-3 gap-6">
        @foreach ($festivals as $festival)
            <div class="border border-gray-700 rounded-lg overflow-hidden shadow-lg bg-gray-800">
                <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-white text-xl font-bold mt-2">{{ $festival->name }}</h2>
                    <p class="text-gray-300">{{ $festival->location }}</p>
                    <p class="text-gray-300">{{ $festival->genre }}</p>
                    <a href="{{ route('festivals.show', $festival->id) }}" class="text-blue-400 underline hover:text-blue-600">View Details</a>
    
                    @if (auth()->check())
                        @if (auth()->user()->favoriteFestivals->contains($festival->id))
                            <!-- Remove from Favorites -->
                            <form action="{{ route('favorites.destroy', $festival->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-2">
                                    Remove from Favorites
                                </button>
                            </form>
                        @else
                            <!-- Add to Favorites -->
                            <form action="{{ route('favorites.store', $festival->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-2">
                                    Add to Favorites
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection