@extends('layouts.app')

@section('title', 'Festivals List')
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

    <div class="container mx-auto mt-4">
        <!-- Search, Filter, and Sort Form -->
        <form method="GET" action="{{ route('festivals.index') }}" class="flex flex-wrap items-center justify-between mb-4 bg-custom-background-dark p-4 rounded-lg">
            <!-- Search -->
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search festivals..." class="p-2 rounded bg-gray-700 text-white">
                <button type="submit" class="bg-custom-blue text-white px-4 py-2 rounded hover:bg-custom-blue-dark">Search</button>
            </div>
    
            <!-- Filter by Genre -->
            <div class="flex items-center space-x-2">
                <select name="genre" class="p-2 rounded bg-gray-700 text-white">
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-custom-pink text-white px-4 py-2 rounded hover:bg-cutom-pink-dark">Filter</button>
            </div>
    
            <!-- Sorting -->
            <div class="flex items-center space-x-2">
                <select name="sort" class="p-2 rounded bg-gray-700 text-white">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="location" {{ request('sort') == 'location' ? 'selected' : '' }}>Location</option>
                    <option value="genre" {{ request('sort') == 'genre' ? 'selected' : '' }}>Genre</option>
                </select>
                <select name="direction" class="p-2 rounded bg-gray-700 text-white">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="bg-custom-yellow text-white px-4 py-2 rounded hover:bg-custom-yellow-dark">Sort</button>
            </div>
        </form>
    
        <div class="mt-8">
            {{ $festivals->links() }}
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6 pt-8">
        @foreach ($festivals as $festival)
            <div class="rounded-lg overflow-hidden shadow-lg bg-custom-background-dark">
                <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-white text-xl font-bold mb-4 mt-2">{{ $festival->name }}</h2>
                    <p class="text-gray-300">{{ $festival->location }}</p>
                    <p class="text-gray-300">{{ $festival->genre }}</p>
                    <div class="flex mt-8 justify-between items-center">
                        <div>
                            <!-- Bouton "View Details" -->
                            <a href="{{ route('festivals.show', $festival->id) }}" class="bg-custom-purple text-white px-4 py-2 rounded hover:bg-custom-purple-dark">
                                View Details
                            </a>
                        </div>

                        @if (auth()->check() && auth()->user()->is_admin)
                            <div class="flex space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('festivals.edit', $festival->id) }}" class="bg-custom-yellow text-white px-4 py-2 rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('festivals.destroy', $festival->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this festival?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div>
                            @if (auth()->check() && auth()->user()->favoriteFestivals->contains($festival->id))
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
                            @else
                                <!-- Add to Favorites -->
                                <form action="{{ route('favorites.store', $festival->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection