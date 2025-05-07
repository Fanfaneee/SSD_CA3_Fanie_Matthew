@extends('layouts.app')

@section('title', $festival->name)
@section('content')
<div class="bg-custom-purple text-center p-2.5">
    <h1 class="text-white text-xl font-bold font-custom-rubik">Find out your favorite festivals in our list!</h1>
</div>
<div class="container mx-auto mt-8">
    <div class="bg-custom-background-dark rounded-lg shadow-lg overflow-hidden">
        <!-- Festival Details -->
        <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-96 object-cover">
        <div class="p-6">
            <h1 class="text-white text-3xl font-bold mb-4">{{ $festival->name }}</h1>
            <p class="text-gray-300 mb-2"><strong>Location:</strong> {{ $festival->location }}</p>
            <p class="text-gray-300 mb-2"><strong>Genre:</strong> {{ $festival->genre }}</p>
            <p class="text-gray-300 mb-2"><strong>Lineup:</strong> {{ $festival->lineup }}</p>
            <p class="text-gray-300 mb-2"><strong>Start Date:</strong> {{ $festival->start_date->format('F j, Y') }}</p>
            <p class="text-gray-300 mb-2"><strong>End Date:</strong> {{ $festival->end_date->format('F j, Y') }}</p>
            <p class="text-gray-300 mb-4"><strong>Price:</strong> {{ $festival->price ? '$' . number_format($festival->price, 2) : 'Free' }}</p>
            <a href="{{ route('festivals.index') }}" class="bg-custom-purple text-white px-4 py-2 rounded hover:bg-custom-purple-dark">
                Back to Festivals
            </a>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-custom-background-dark rounded-lg shadow-lg overflow-hidden mt-8 p-6">
      <!-- Display Comments -->
@forelse ($comments as $comment)
<div class="mb-4">
    <p class="text-gray-300"><strong>{{ $comment->user->name }}</strong> said:</p>
    <p class="text-gray-400">{{ $comment->content }}</p>
    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>

    <!-- Edit and Delete Options -->
    @if (auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->is_admin))
        <div class="flex space-x-2 mt-2">
            <!-- Edit Button -->
            <button onclick="document.getElementById('edit-comment-{{ $comment->id }}').classList.toggle('hidden')" 
                    class="text-blue-500 hover:underline">
                Edit
            </button>

            <!-- Delete Form -->
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Delete</button>
            </form>
        </div>

        <!-- Edit Form -->
        <div id="edit-comment-{{ $comment->id }}" class="hidden mt-2">
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf
                @method('PATCH')
                <textarea name="content" rows="2" class="w-full p-2 rounded bg-gray-700 text-white" required>{{ $comment->content }}</textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">
                    Update Comment
                </button>
            </form>
        </div>
    @endif
</div>
@empty
<p class="text-gray-400">No comments yet. Be the first to comment!</p>
@endforelse
        <!-- Add a Comment -->
        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="festival_id" value="{{ $festival->id }}">
                <textarea name="content" rows="3" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Write your comment here..." required></textarea>
                <button type="submit" class="bg-custom-purple text-white px-4 py-2 rounded hover:bg-custom-purple-dark mt-2">
                    Submit Comment
                </button>
            </form>
        @else
            <p class="text-gray-400 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to leave a comment.</p>
        @endauth
    </div>
</div>
@endsection