<x-app-layout>
    <form action="{{ route('interactions.store') }}" method="POST">
        @csrf
        <label for="customer_id">Customer:</label>
        <select name="customer_id" required>
            <option value="" disabled selected>Select a customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <label for="date_time">Date and Time:</label>
        <input type="datetime-local" name="date_time" required>

        <label for="type">Type:</label>
        <input type="text" name="type" required>

        <label for="notes">Notes:</label>
        <textarea name="notes" rows="4"></textarea>

        <button class="confirmButton" type="submit">Log Interaction</button>
        <a href="{{ route('interactions.index') }}" class="cancelButton">Cancel</a>
    </form>

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

        form {
            background-color: var(--background-color);
            color: black;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 10rem auto; 
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select, input[type="datetime-local"], textarea {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            font-size: 16px; 
            transition: border-color 0.3s; 
        }

        select:focus, input[type="datetime-local"]:focus, textarea:focus {
            border-color: #007bff; 
            outline: none;
        }

        .confirmButton {
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .confirmButton:hover {
            background-color: #0056b3; 
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
