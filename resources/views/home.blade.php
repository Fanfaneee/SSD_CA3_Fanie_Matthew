@extends('layouts.app')

@section('content')

<div class="bg-blue-200">
    Welcomeee
</div>
<div style="background-color: #3A86FF;">
    <h1>Blue</h1>
</div>
<div class="bg-custom-purple">
    <h1>Purple</h1>
</div>
<div class="bg-custom-pink">
    <h1>Pink</h1>
</div>
<div class="bg-custom-orange">
    <h1>Orange</h1>
</div>
<div class="bg-custom-yellow">
    <h1>Yellow</h1>
</div>

<!-- Add the image -->
<div class="mt-4">
    <img src="{{ asset('images/image_crop.jpg') }}" alt="Image Crop" class="w-full h-auto">
</div>

<div class="mt-4">
    <a href="{{ route('festivals') }}" class="text-blue-500 underline">Go to Festivals Page</a>
</div>
<div class="mt-4">
    <a href="{{ route('map') }}" class="text-blue-500 underline">Go to map Page</a>
</div>
<div class="mt-4">
    <a href="{{ route('calendar') }}" class="text-blue-500 underline">Go to calendar Page</a>
</div>
<div class="mt-4">
    <a href="{{ route('contact') }}" class="text-blue-500 underline">Go to contact Page</a>
</div>
<div>
    <a href="{{ route('home') }}" class="text-blue-500 underline">Go to Home Page</a>
</div>
@endsection