<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Interaction Tracking</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4 w-full">
            <form action="{{ route('interactions.index') }}" method="GET" class="w-3/5">
                <div class="flex items-center">
                    <input type="text" name="query" placeholder="Search by name..." class="bg-gray-200 text-black dark:text-white dark:bg-gray-700 py-2 px-4 rounded-l-lg w-full mb-0 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500" value="{{ request()->input('query') }}">

                    <button type="submit" class="searchButton">
                        Search
                    </button>

                    <a href="{{ route('interactions.index') }}" class="bg-red-400 text-black font-bold py-2 px-4 rounded-lg ml-2 transition duration-300 ease-in-out transform hover:scale-105">
                        Clear
                    </a>
                </div>
            </form>

            <a href="{{ route('interactions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-0 inline-block transition duration-300 ease-in-out transform hover:scale-105">
                Add New Interaction
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="interaction-table">
                <thead>
                    <tr>
                        <th>Interaction Name</th>
                        <th>Date Time</th>
                        <th>Type</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interactions as $interaction)
                        <tr>
                            <td >{{ $interaction->customer->name }}</td>
                            <td >{{ $interaction->date_time }}</td>
                            <td>{{ $interaction->type }}</td>
                            <td class="notes-cell">{{ $interaction->notes }}</td>
                            <td>
                                <a href="{{ route('interactions.edit', $interaction->id) }}" class="action-button ml-3">Edit</a>
                                <form action="{{ route('interactions.destroy', $interaction->id) }}"  onsubmit="return confirm('Are you sure you want to delete this interaction?');" method="POST" class="inline-block ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Delete</button>
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
        .interaction-table {
            min-width: 100%;
            background-color: var(--input-background);
            color: var(--input-text);
        }

        .interaction-table th,
        .interaction-table td {
            padding: 8px 12px;  
            border-bottom: 1px solid #e2e8f0; 
        }

        .interaction-table tbody tr:hover {
            background-color: #b9b9b9be;
        }

        .action-button {
            color: #f6ad55; 
            transition: color 0.3s;
        }

        .action-button:hover {
            color: #dd6b20;
        }

        .delete-button {
            color: #e53e3e;
            transition: color 0.3s; 
        }

        .delete-button:hover {
            color: #c53030; 
        }

        .notes-cell {
            min-width: 300px; 
            overflow: hidden; 
            white-space: nowrap; 
            text-overflow: ellipsis;
        }
        
        .searchButton {
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            margin-left:10px;
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .searchButton:hover {
            background-color: #0056b3;
        }

    </style>
</x-app-layout>
