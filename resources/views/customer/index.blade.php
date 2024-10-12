<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Customers</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('customer.index') }}" method="GET" class="w-2/5">
                <div class="flex">
                    <input type="text" name="query" placeholder="Search by name..." class="input-search" value="{{ request()->input('query') }}">
                    <button type="submit" class="btn-primary">Search</button>
                </div>
            </form>
        
            <a href="{{ route('customer.create') }}" class="btn-primary">
                Add New Customer
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table bg-white dark:bg-gray-800">
                <thead>
                    <tr class="table-header text-gray-900 dark:text-gray-100">
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
                                <a href="{{ route('customer.edit', $customer->id) }}" class="ml-3 text-yellow-500 hover:text-yellow-700">Edit</a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Are you sure you want to delete this customer?');">
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

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>

    <style>
        :root {
            --background-color: #f8f9fa;
            --text-color: #212529;
            --input-background: #ffffff;
            --input-text: #212529;
            --input-border: #ced4da;
            --button-primary-bg: #007bff;
            --button-secondary-bg: #6c757d;
            --alert-success-bg: #d4edda;
            --alert-success-text: #155724;
            --table-header-bg: #e9ecef;
            --table-row-hover-bg: rgba(0, 123, 255, 0.1);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --background-color: #343a40;
                --text-color: #ffffff;
                --input-background: #495057;
                --input-text: #ffffff;
                --input-border: #6c757d;
                --button-primary-bg: #0d6efd;
                --button-secondary-bg: #adb5bd;
                --alert-success-bg: #c3e6cb;
                --alert-success-text: #155724;
                --table-header-bg: #454d55;
                --table-row-hover-bg: rgba(0, 123, 255, 0.2);
            }
        }

        .alert-success {
            background-color: var(--alert-success-bg);
            color: var(--alert-success-text);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .form-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            width: 100%; 
        }

        .input-search {
            background-color: var(--input-background);
            border: 1px solid var(--input-border);
            color: var(--input-text);
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            margin-right: 10px;
        }

        .table-header {
            background-color: var(--table-header-bg);
        }

        .hover\:bg-gray-50:hover {
            background-color: var(--table-row-hover-bg);
        }

        .btn-primary {
            background-color: var(--button-primary-bg);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: var(--button-secondary-bg);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #dddddd6c;
            text-align: center;
        }
        
    </style>
</x-app-layout>
