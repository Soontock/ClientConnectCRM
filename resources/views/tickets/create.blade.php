<x-app-layout>
    <div class="container form-container">
        <h1>Create New Ticket</h1>

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
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
          
                <input type="hidden" id="customer_id" name="customer_id">
                Customer Name: <input class="customerNameBox" type="text" id="name" name="name" disabled>
                <small id="emailError" class="text-red-500 hidden">Customer not found.</small>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="inProgress" {{ old('status') == 'inProgress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="" disabled selected>Select Priority</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Ticket</button>
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

<!-- External CSS Styles -->
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

    .form-container {
        background-color: var(--background-color);
        color: var(--text-color);
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        margin: 15px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    .form-group {
        margin: 10px 0;
    }

    .form-control {
        background-color: var(--input-background);
        color: var(--input-text);
        border: 1px solid var(--input-border);
        padding: 10px;
        border-radius: 4px;
        width: 100%;
    }

    .btn-primary {
        background-color: var(--button-primary-bg);
        border-color: var(--button-primary-bg);
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .customerNameBox{
        border:0;
        background:none;
        margin-top:1px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: var(--button-secondary-bg);
        border-color: var(--button-secondary-bg);
        color: white;
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
</style>
