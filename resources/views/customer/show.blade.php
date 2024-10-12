<x-app-layout>
    <div class="detailContainer">
        <h1 class="text-2xl font-semibold mb-4">Customer Details</h1>

        <h2 class="customer-name">{{ $customer->name }}</h2>
        <p class="customer-info"><strong>Email:</strong> {{ $customer->email }}</p>
        <p class="customer-info"><strong>ID Number:</strong> {{ $customer->id_number }}</p>
        <p class="customer-info"><strong>Phone Number:</strong> {{ $customer->phoneNum }}</p>
        <p class="customer-info"><strong>Address:</strong> {{ $customer->address }}</p>
        <p class="customer-info"><strong>Notes:</strong> {{ $customer->notes }}</p>

        <button onclick="window.history.back();" class="back-button">Back</button>
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
            }
        }

        .detailContainer {
            background-color: var(--background-color);
            color: var(--text-color);
            max-width: 600px;
            margin: 10rem auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .customer-name {
            font-size: 1.5rem; 
            font-weight: bold; 
            margin-bottom: 1rem; 
        }

        .customer-info {
            margin-bottom: 0.5rem; 
        }

        .back-button {
            background-color: #4B5563; 
            color: white; 
            padding: 10px 16px; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
            margin-top: 16px; 
            display: inline-block; 
        }

        .back-button:hover {
            background-color: #2D3748; 
        }
    </style>

</x-app-layout>
