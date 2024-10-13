<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">User</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4 w-full">
            <form action="{{ route('user.index') }}" method="GET" class="w-3/5">
                <div class="flex">
                    <input type="text" name="query" placeholder="Search by name..." class="search-input" value="{{ request()->input('query') }}">

                    <button type="submit" class="search-button">
                        Search
                    </button>

                    <a href="{{ route('user.index') }}" class="clear-button">
                        Clear
                    </a>
                </div>
            </form>

            <a href="{{ route('user.create') }}" class="add-button">
                Add New User
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-user">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->userType }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="editButton">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block ml-3"  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="deleteButton">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</x-app-layout>
