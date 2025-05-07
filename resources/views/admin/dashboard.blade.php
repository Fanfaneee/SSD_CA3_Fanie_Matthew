@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-[85%] px-4 text-white">
    <h1 class="text-2xl font-bold mt-4 mb-4">Welcome to the Admin Dashboard</h1>
    

    <!-- Users Table -->
    <div class="mt-6">
        <h2 class="text-xl font-bold mb-4 cursor-pointer text-center" onclick="toggleTable('users-table')">All Users</h2>
        <div id="users-table" class="overflow-x-auto">
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
                                    Edit
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
    </div>

    <!-- Contact Submissions Table -->
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-4 cursor-pointer text-center" onclick="toggleTable('contacts-table')">Contact Submissions</h2>
        <div id="contacts-table" class="overflow-x-auto">
            <table class="table-auto w-full text-left bg-gray-800 text-white rounded-lg">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr class="border-t border-gray-600">
                            <td class="px-4 py-2">{{ $contact->id }}</td>
                            <td class="px-4 py-2">{{ $contact->name }}</td>
                            <td class="px-4 py-2">{{ $contact->email }}</td>
                            <td class="px-4 py-2 break-words whitespace-normal">{{ $contact->message }}</td>
                            <td class="px-4 py-2">
                                <!-- Delete Button -->
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Comments Table -->
    <div class="mt-12 mb-12 ">
        <h2 class="text-xl font-bold mb-4 cursor-pointer text-center" onclick="toggleTable('comments-table')">All Comments</h2>
        <div id="comments-table" class="overflow-x-auto">
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
                            <td class="px-4 py-2 break-words whitespace-normal">{{ $comment->content }}</td>
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
</div>

<script>
    function toggleTable(tableId) {
        const table = document.getElementById(tableId);
        table.classList.toggle('hidden');
    }
</script>
@endsection