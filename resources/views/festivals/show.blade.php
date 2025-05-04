@extends('layouts.app')

@section('content')
<div class="bg-custom-purple text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals in our list!</h1>
</div>
<div class="container mx-auto mt-8">
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Image du festival -->
        <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-96 object-cover">

        <!-- Contenu du festival -->
        <div class="p-6">
            <h1 class="text-white text-3xl font-bold mb-4">{{ $festival->name }}</h1>
            <p class="text-gray-300 mb-2"><strong>Location:</strong> {{ $festival->location }}</p>
            <p class="text-gray-300 mb-2"><strong>Genre:</strong> {{ $festival->genre }}</p>
            <p class="text-gray-300 mb-2"><strong>Lineup:</strong> {{ $festival->lineup }}</p>
            <p class="text-gray-300 mb-2"><strong>Start Date:</strong> {{ $festival->start_date->format('F j, Y') }}</p>
            <p class="text-gray-300 mb-2"><strong>End Date:</strong> {{ $festival->end_date->format('F j, Y') }}</p>
            <p class="text-gray-300 mb-4"><strong>Price:</strong> {{ $festival->price ? '$' . number_format($festival->price, 2) : 'Free' }}</p>

            <!-- Bouton pour revenir à la liste des festivals -->
            <a href="{{ route('festivals.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Back to Festivals
            </a>
        </div>
    </div>
</div>

@endsection