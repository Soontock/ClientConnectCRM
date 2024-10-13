<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Customers</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="customerIndexForm-container">
            <form action="{{ route('customer.index') }}" method="GET" class="w-2/5">
                <div class="flex">
                    <input type="text" name="query" placeholder="Search by name..." class="search-input" value="{{ request()->input('query') }}">
                    <button type="submit" class="search-button">Search</button>

                    <a href="{{ route('customer.index') }}" class="clear-button">
                        Clear
                    </a>
                </div>
            </form>
        
            <a href="{{ route('customer.create') }}" class="add-button">
                Add New Customer
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-customer">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phoneNum }}</td>
                            <td>
                                <a href="{{ route('customer.show', $customer->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                <a href="{{ route('customer.edit', $customer->id) }}" class="editButton ml-3">Edit</a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Are you sure you want to delete this customer?');">
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

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>

</x-app-layout>
