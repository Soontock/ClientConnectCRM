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
                <div class="flex items-center">
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
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <th class="table-header">User Name</th>
                        <th class="table-header">Email</th>
                        <th class="table-header">Role</th>
                        <th class="table-header">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="table-cell">{{ $user->name }}</td>
                            <td class="table-cell">{{ $user->email }}</td>
                            <td class="table-cell">{{ $user->userType }}</td>
                            <td class="table-cell">
                                <a href="{{ route('user.edit', $user->id) }}" class="ml-3 text-yellow-500 hover:text-yellow-700">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block ml-3"  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        :root {
            --background-color: #fff;
            --text-color: #000;
            --input-background: #fff;
            --input-text: #000;
            --input-border: #ccc;
            --button-primary-bg: #007bff;
            --button-secondary-bg: #6c757d;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --background-color: #000;
                --text-color: #fff;
                --input-background: #333;
                --input-text: #fff;
                --input-border: #555;
                --button-primary-bg: #0d6efd;
                --button-secondary-bg: #adb5bd;
            }
        }

        .search-input {
            background-color: var(--input-background);
            color: var(--input-text);
            padding: 10px;
            border-radius: 0.375rem; 
            border: 1px solid var(--input-border);
            width: 100%;
            margin-bottom: 0; 
            margin-right:5px;
        }

        .search-button {
            background-color: var(--button-primary-bg);
            color: white;
            padding: 0.5rem 1rem; 
            border-radius: 0.375rem; 
            transition: background-color 0.3s, transform 0.3s;
        }

        .search-button:hover {
            background-color: #0056b3; 
            transform: scale(1.05);
        }

        .clear-button {
            background-color: #ff4d4d;
            color: black;
            padding: 0.5rem 1rem; 
            border-radius: 0.375rem; 
            margin-left: 0.5rem; 
            transition: background-color 0.3s, transform 0.3s;
        }

        .clear-button:hover {
            background-color: #ff1a1a; 
            transform: scale(1.05);
        }

        .add-button {
            background-color: var(--button-primary-bg);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem; 
            transition: background-color 0.3s, transform 0.3s;
        }

        .add-button:hover {
            background-color: #0056b3; 
            transform: scale(1.05);
        }

        th, td {
            padding: 0.5rem;
            text-align: center;
        }

        .table-cell {
            padding: 0.5rem 1rem; 
            border-bottom: 1px solid #ccc; 
        }

        .table-header {
            padding: 0.5rem; 
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
    </style>
</x-app-layout>
