<x-app-layout>
    <div class="container form-container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="userType">Role</label>
                <input type="text" class="form-control" id="userType" name="userType" value="{{ old('userType', $user->userType) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('user.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>

<!-- Styling Section -->
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

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background-color: var(--background-color);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
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
        
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--input-border);
        border-radius: 5px;
        background-color: var(--input-background);
        color: var(--input-text);
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--input-focus-border);
        outline: none;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: var(--button-primary-bg);
        color: white;
    }

    .btn-primary:hover {
        background-color: darken(var(--button-primary-bg), 10%);
    }

    .btn-secondary {
        background-color: var(--button-secondary-bg);
        color: white;
        margin-left: 10px;
    }

    .btn-secondary:hover {
        background-color: darken(var(--button-secondary-bg), 10%);
    }

    .alert {
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
