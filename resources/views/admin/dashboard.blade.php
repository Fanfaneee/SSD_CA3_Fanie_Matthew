@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>You are logged in as an admin.</p>

    <!-- Users Table -->
    <div class="mt-6">
        <h2 class="text-xl font-bold mb-4">All Users</h2>
        <table class="table-auto w-full text-left bg-gray-800 text-white rounded-lg">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-gray-600">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        <td class="px-4 py-2">
                            <!-- Modify Button -->
                            <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                Modify
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                            <!-- Admin Role Buttons -->
                            @if ($user->is_admin)
                                <!-- Demote Admin Button -->
                                <form action="{{ route('admin.users.demoteAdmin', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                        Demote Admin
                                    </button>
                                </form>
                            @else
                                <!-- Make Admin Button -->
                                <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                                        Make Admin
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Comments Table -->
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-4">All Comments</h2>
        <table class="table-auto w-full text-left bg-gray-800 text-white rounded-lg">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Festival</th>
                    <th class="px-4 py-2">Content</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="border-t border-gray-600">
                        <td class="px-4 py-2">{{ $comment->id }}</td>
                        <td class="px-4 py-2">{{ $comment->user->name }}</td>
                        <td class="px-4 py-2">{{ $comment->festival->name }}</td>
                        <td class="px-4 py-2">{{ $comment->content }}</td>
                        <td class="px-4 py-2">
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('edit-comment-{{ $comment->id }}').classList.toggle('hidden')" 
                                    class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                            <!-- Edit Form -->
                            <div id="edit-comment-{{ $comment->id }}" class="hidden mt-2">
                                <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <textarea name="content" rows="2" class="w-full p-2 rounded bg-gray-700 text-white" required>{{ $comment->content }}</textarea>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">
                                        Update Comment
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection