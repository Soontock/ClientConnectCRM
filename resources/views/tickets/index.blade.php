<x-app-layout>
    <div class="p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Helpdesk Ticket</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4 w-full">
            <form action="{{ route('tickets.index') }}" method="GET" class="w-3/5">
                <div class="flex items-center">
                    <input type="text" name="query" placeholder="Search by title..." class="bg-gray-200 text-black dark:text-white dark:bg-gray-700 py-2 px-4 rounded-l-lg w-full mb-0 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500" value="{{ request()->input('query') }}">
                    
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg ml-2 transition duration-300 ease-in-out transform hover:scale-105">
                        Search
                    </button>
            
                    <a href="{{ route('tickets.index') }}" class="bg-red-400 text-black font-bold py-2 px-4 rounded-lg ml-2 transition duration-300 ease-in-out transform hover:scale-105">
                        Clear
                    </a>
                </div>
            
                <div class="flex mt-4">
                    <select name="status" class="status-select ml-2">
                        <option value="" {{ request()->input('status') ? '' : 'selected' }}>Select Status</option>
                        <option value="open" {{ request()->input('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="inProgress" {{ request()->input('status') == 'inProgress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ request()->input('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request()->input('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
            
                    <select name="priority" class="priority-select ml-2">
                        <option value="" {{ request()->input('priority') ? '' : 'selected' }}>Select Priority</option>
                        <option value="low" {{ request()->input('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request()->input('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request()->input('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
            </form>
   
            <a href="{{ route('tickets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-0 inline-block transition duration-300 ease-in-out transform hover:scale-105">
                Add New Ticket
            </a>
        </div>        

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <th class="table-header">Name</th>
                        <th class="table-header">Title</th>
                        <th class="table-header">Description</th>
                        <th class="table-header">Status</th>
                        <th class="table-header">Priority</th>  
                        <th class="table-header">Date Time</th>
                        <th class="table-header">Assign To</th>
                        <th class="table-header">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="table-cell">{{ $ticket->customer->name }}</td>
                            <td class="table-cell">{{ $ticket->title }}</td>
                            <td class="table-cell">{{ $ticket->description }}</td>
                            <td class="table-cell">{{ $ticket->status }}</td>
                            <td class="table-cell">{{ $ticket->priority }}</td>
                            <td class="table-cell">{{ $ticket->created_at }}</td>
                            <td class="table-cell">
                                @if ($ticket->assignments->isNotEmpty())
                                    @foreach ($ticket->assignments as $assignment)
                                        <span class="block">{{ $assignment->user->name }}</span>
                                    @endforeach
                                @else
                                    <span class="block text-gray-500">Not assigned</span>
                                @endif
                            </td>
                            <td class="table-cell">
                                @if (Auth::user()->userType != 'support') 
                                    <button type="button" class="text-blue-500 hover:text-blue-700" onclick="openModal('{{ $ticket->id }}')">
                                        Assign
                                    </button>
                                @else
                                    <span class="text-gray-500"></span>
                                @endif
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="ml-3 text-yellow-500 hover:text-yellow-700">Edit</a>
                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
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
            {{ $tickets->links() }}
        </div>
    </div>

    <div id="assignModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="ticketTitle">Assign Ticket</h2>

            <form action="{{ route('tickets.assign') }}" method="POST">
                @csrf
                <input type="hidden" id="ticket_id" name="ticket_id">

                <div class="mb-4">
                    <label for="search_user" class="block text-gray-700 dark:text-gray-200">Search User</label>
                    <input type="text" id="search_user" class="border border-gray-300 dark:border-gray-600 rounded py-2 px-4 w-full" placeholder="Search users..." oninput="filterUsers()">
                </div>

                <div class="form-group">
                    <label for="assigned_user">Assign to User</label>
                    <select id="assigned_user" name="assigned_user" class="form-control" required>
                        <option value="" disabled selected>Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" class="user-option">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Assign</button>
                    <button type="button" class="cancelButton" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(ticketId) {
            document.getElementById('ticket_id').value = ticketId; 
            document.getElementById('assignModal').classList.remove('hidden'); 
        }

        function closeModal() {
            document.getElementById('assignModal').classList.add('hidden'); 
        }

        function filterUsers() {
            const input = document.getElementById('search_user');
            const filter = input.value.toLowerCase();
            const options = document.querySelectorAll('.user-option');

            options.forEach(option => {
                const text = option.textContent || option.innerText;
                option.style.display = text.toLowerCase().includes(filter) ? '' : 'none';
            });
        }
    </script>

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

        /* Dark mode variables */
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

        .status-select,
        .priority-select {
            background-color: var(--input-background);
            color: var(--input-text);
            padding: 0.5rem 1rem; 
            border-radius: 0.375rem; 
            border: 1px solid var(--input-border);
            margin-left: 0.5rem;
            transition: background-color 0.3s, transform 0.3s; 
        }

        .status-select:hover,
        .priority-select:hover {
            background-color: #6c757d;
        }

        .form-group,
        .assigned_user{
            background-color: none;
            color: #fff;
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
        
        .dropdown-container {
            display: flex;
            gap: 1rem; 
            margin-top:10px;
        }

        .ticketTitle{
            color: var(--input-text);
            font-size: 20px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            background-color: #6c757d;
            color: #000;
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 0.375rem;
            cursor: pointer;
        }

        .dropdown-button:hover {
            background-color: #e2e8f0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            min-width: 160px;
            z-index: 1;
            border-radius: 0.375rem;
        }

        .dropdown-content a {
            color: black;
            padding: 0.5rem 1rem;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #e2e8f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .active {
            font-weight: bold;
            background-color: #d1d5db; 
        }

        .dropdown-content a.active:hover {
            background-color: #b0b8c1;
        }


        .form-control {
            background-color: #fff;
            color: #000;
            border: 1px solid var(--input-border);
            border-radius: 5px; 
            padding: 10px;
            width: 100%; 
            transition: border-color 0.3s; 
        }

        .form-control:focus {
            border-color: var(--button-primary-bg); 
            outline: none; 
        }

        .btn-primary {
            background-color: var(--button-primary-bg);
            border-color: var(--button-primary-bg);
            padding: 10px 15px; 
            border-radius: 5px;
            transition: background-color 0.3s; 
        }

        .btn-primary:hover {
            background-color: var(--button-secondary-bg);
        }

        .btn-secondary {
            background-color: var(--button-secondary-bg);
            border-color: var(--button-secondary-bg);
            padding: 10px 15px;
            border-radius: 5px; 
            transition: background-color 0.3s; 
        }

        .btn-secondary:hover {
            background-color: #5a6268; 
        }
        .alert-danger {
            background-color: #ff4d4d;
            color: #000;
            padding: 10px; 
            border-radius: 5px; 
        }

        #assignModal {
            z-index: 1000; 
        }
        th:nth-child(2), td:nth-child(2), th:nth-child(3), td:nth-child(3) {
            width: 200px; 
        }

        .cancelButton {
            display: inline-block; 
            margin-top: 10px; 
            padding: 10px 15px; 
            background-color: red;
            color: white; 
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s; 
        }

        .cancelButton:hover {
            background-color: darkred; 
        }
    </style>
</x-app-layout>
