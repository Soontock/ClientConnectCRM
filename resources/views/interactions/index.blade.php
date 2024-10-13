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
                <div class="flex">
                    <input type="text" name="query" placeholder="Search by name..." class="search-input"
                        value="{{ request()->input('query') }}">

                    <button type="submit" class="search-button">
                        Search
                    </button>

                    <a href="{{ route('interactions.index') }}" class="clear-button">
                        Clear
                    </a>
                </div>
            </form>

            <a href="{{ route('interactions.create') }}" class="add-button">
                Add New Interaction
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-interaction">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <th>Interaction Name</th>
                        <th>Date Time</th>
                        <th>Type</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interactions as $interaction)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td>{{ $interaction->customer->name }}</td>
                            <td>{{ $interaction->date_time }}</td>
                            <td>{{ $interaction->type }}</td>
                            <td class="notes-cell">{{ $interaction->notes }}</td>
                            <td>
                                <a href="{{ route('interactions.edit', $interaction->id) }}"
                                    class="editButton ml-3">Edit</a>
                                <form action="{{ route('interactions.destroy', $interaction->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this interaction?');"
                                    method="POST" class="inline-block ml-3">
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
