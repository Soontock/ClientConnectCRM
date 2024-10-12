<x-app-layout>
    <div class="form-container">
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
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $tickets->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $tickets->description) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="open" {{ old('status', $tickets->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="inProgress" {{ old('status', $tickets->status) == 'inProgress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ old('status', $tickets->status) == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status', $tickets->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="" disabled selected>Select Priority</option>
                    <option value="low" {{ old('priority', $tickets->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $tickets->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $tickets->priority) == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Ticket</button>
            <a href="{{ route('tickets.index') }}" class="cancelButton">Cancel</a>
        </form>
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
        --alert-danger-bg: #f8d7da;
        --alert-danger-text: #721c24;
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
            --alert-danger-bg: #f5c6cb;
            --alert-danger-text: #721c24;
        }
    }
        .form-group {
            margin: 10px 0;
        }

        .form-container {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px;
            border-radius: 10px;
            width: 80%; 
            margin: 15px auto; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .form-control {
            background-color: var(--input-background);
            color: var(--input-text);
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
