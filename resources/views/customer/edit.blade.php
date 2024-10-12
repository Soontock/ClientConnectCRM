<x-app-layout>
    <div class="container form-container">
        <h1>Edit Customer</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            </div>

            <div class="form-group">
                <label for="id_number">ID Number</label>
                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number', $customer->id_number) }}" required>
            </div>

            <div class="form-group">
                <label for="phoneNum">Phone Number</label>
                <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="{{ old('phone', $customer->phoneNum) }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" required>{{ old('address', $customer->address) }}</textarea>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes">{{ old('notes', $customer->notes) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Customer</button>
            <button type="button" class="cancelButton" onclick="window.history.back();">Cancel</button>
        </form>
    </div>
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
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        margin: 20px auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #fff;
        color: #000;
        border: 1px solid var(--input-border);
        border-radius: 5px;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--button-primary-bg);
        outline: none;
    }

    button {
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: var(--button-primary-bg);
        color: white;
        border: none;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: var(--button-secondary-bg);
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: var(--alert-danger-bg);
        color: var(--alert-danger-text);
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
