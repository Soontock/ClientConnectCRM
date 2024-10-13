<x-app-layout>
    <div class="ticket-container">
        <h1 class="text-2xl font-semibold mb-4">Edit Ticket</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div>Error: Please try again.</div>
            </div>
        @endif

        <form action="{{ route('tickets.update', $tickets->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="ticket-control" id="title" name="title"
                    value="{{ old('title', $tickets->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="ticket-control" id="description" name="description"
                    value="{{ old('description', $tickets->description) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="ticket-control" id="status" name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="open" {{ old('status', $tickets->status) == 'open' ? 'selected' : '' }}>Open
                    </option>
                    <option value="inProgress" {{ old('status', $tickets->status) == 'inProgress' ? 'selected' : '' }}>
                        In Progress</option>
                    <option value="resolved" {{ old('status', $tickets->status) == 'resolved' ? 'selected' : '' }}>
                        Resolved</option>
                    <option value="closed" {{ old('status', $tickets->status) == 'closed' ? 'selected' : '' }}>Closed
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="ticket-control" id="priority" name="priority" required>
                    <option value="" disabled selected>Select Priority</option>
                    <option value="low" {{ old('priority', $tickets->priority) == 'low' ? 'selected' : '' }}>Low
                    </option>
                    <option value="medium" {{ old('priority', $tickets->priority) == 'medium' ? 'selected' : '' }}>
                        Medium</option>
                    <option value="high" {{ old('priority', $tickets->priority) == 'high' ? 'selected' : '' }}>High
                    </option>
                </select>
            </div>

            <button type="submit" class="confirmButton">Update Ticket</button>
            <a href="{{ route('tickets.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>
