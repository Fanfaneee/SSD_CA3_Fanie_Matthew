@extends('layouts.app')

@section('content')
<div class="bg-custom-yellow text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Any question? Contact Us!</h1>
</div>

<div class="container mx-auto mt-8">
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Texte ajouté au-dessus du formulaire -->
    <p class="text-gray-300 text-center mb-6">
        You want to add a festival to our list? You want to have more information about a festival or share your feedback? Fill out the form below and we will get back to you as soon as possible!
    </p>

    <form action="{{ route('contact.store') }}" method="POST" class="bg-custom-background-dark p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-300">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-300">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 rounded bg-gray-700 text-white" required>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-300">Message</label>
            <textarea name="message" id="message" rows="4" class="w-full p-2 rounded bg-gray-700 text-white" required></textarea>
        </div>
        <button type="submit" class="bg-custom-yellow text-white px-4 py-2 rounded hover:bg-custom-yellow-dark">
            Send Message
        </button>
    </form>
</div>
@endsection