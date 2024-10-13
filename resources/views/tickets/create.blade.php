<x-app-layout>
    <div class="ticket-container">
        <h1 class="text-2xl font-semibold mb-4">Create New Ticket</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Customer Email</label>
                <input type="text" class="ticket-control" id="email" name="email" value="{{ old('email') }}"
                    required>

                <input type="hidden" id="customer_id" name="customer_id">
                Customer Name: <input class="customerNameBox" type="text" id="name" name="name" disabled>
                <small id="emailError" class="text-red-500 hidden">Customer not found.</small>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="ticket-control" id="title" name="title" value="{{ old('title') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="ticket-control" id="description" name="description"
                    value="{{ old('description') }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="ticket-control" id="status" name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="inProgress" {{ old('status') == 'inProgress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="ticket-control" id="priority" name="priority" required>
                    <option value="" disabled selected>Select Priority</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="confirmButton">Create Ticket</button>
            <a href="{{ route('tickets.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>

    <script>
        document.getElementById('email').addEventListener('blur', function() {
            let email = this.value;

            if (email) {
                fetch(`/search-customer?email=${email}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.customer) {
                            document.getElementById('customer_id').value = data.customer.id;
                            document.getElementById('name').value = data.customer.name;
                            document.getElementById('emailError').classList.add('hidden');
                        } else {
                            document.getElementById('customer_id').value = '';
                            document.getElementById('name').value = '';
                            document.getElementById('emailError').classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.log('Error:', error);
                    });
            }
        });
    </script>
</x-app-layout>
