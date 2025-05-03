@extends('layouts.app')

@section('content')

<div class="bg-custom-purple text-center p-2.5" >
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals in our list !</h1>
</div>
<div class="container">
    
    <div class="grid grid-cols-3 gap-4">
        @foreach ($festivals as $festival)
            <div class="border p-4">
                <img src="{{ asset($festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                <h2 class="text-xl font-bold mt-2">{{ $festival->name }}</h2>
                <p>{{ $festival->location }}</p>
                <p>{{ $festival->genre }}</p>
                <a href="{{ route('festivals.show', $festival->id) }}" class="text-blue-500 underline">View Details</a>
            </div>
        @endforeach
    </div>
</div>

@endsection