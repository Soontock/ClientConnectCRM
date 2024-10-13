<x-app-layout>
    <div class=" p-6 text-gray-900 dark:text-gray-100 max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Helpdesk Ticket</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4 w-full">
            <form action="{{ route('tickets.index') }}" method="GET" class="w-3/5">
                <div class="flex">
                    <input type="text" name="query" placeholder="Search by title..." class="search-input"  value="{{ request()->input('query') }}">
                    
                    <button type="submit"  class="search-button">
                        Search
                    </button>
            
                    <a href="{{ route('tickets.index') }}" class="clear-button">
                        Clear
                    </a>
                </div>
            
                <div class="flex mt-4">
                    <select name="status" class="status-select">
                        <option value="" {{ request()->input('status') ? '' : 'selected' }}>Select Status</option>
                        <option value="open" {{ request()->input('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="inProgress" {{ request()->input('status') == 'inProgress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ request()->input('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request()->input('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
            
                    <select name="priority" class="priority-select">
                        <option value="" {{ request()->input('priority') ? '' : 'selected' }}>Select Priority</option>
                        <option value="low" {{ request()->input('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request()->input('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request()->input('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
            </form>
   
            <a href="{{ route('tickets.create') }}"class="add-button">
                Add New Ticket
            </a>
        </div>        

        <div class="overflow-x-auto">
            <table class="table-ticket">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>  
                        <th>Date Time</th>
                        <th>Assign To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td>{{ $ticket->customer->name }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->priority }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>
                                @if ($ticket->assignments->isNotEmpty())
                                    @foreach ($ticket->assignments as $assignment)
                                        <span class="block">{{ $assignment->user->name }}</span>
                                    @endforeach
                                @else
                                    <span class="block text-gray-500">Not assigned</span>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->userType != 'support') 
                                    <button type="button" class="text-blue-500 hover:text-blue-700" onclick="openModal('{{ $ticket->id }}')">
                                        Assign
                                    </button>
                                @else
                                    <span class="text-gray-500"></span>
                                @endif
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="editButton">Edit</a>
                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
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
            {{ $tickets->links() }}
        </div>
    </div>

    <div id="assignModal" class="ticketContainer fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
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
        #assignModal {
            z-index: 1000; 
        }
        th:nth-child(2), td:nth-child(2), th:nth-child(3), td:nth-child(3) {
            width: 200px; 
        }
    </style>
</x-app-layout>
