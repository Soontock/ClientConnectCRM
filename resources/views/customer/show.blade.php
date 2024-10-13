<x-app-layout>
    <div class="detailContainer">
        <h1 class="text-2xl font-semibold mb-4">Customer Details</h1>

        <h2 class="customer-name">{{ $customer->name }}</h2>
        <p class="customer-info"><strong>Email:</strong> {{ $customer->email }}</p>
        <p class="customer-info"><strong>ID Number:</strong> {{ $customer->id_number }}</p>
        <p class="customer-info"><strong>Phone Number:</strong> {{ $customer->phoneNum }}</p>
        <p class="customer-info"><strong>Address:</strong> {{ $customer->address }}</p>
        <p class="customer-info"><strong>Notes:</strong> {{ $customer->notes }}</p>

        <button onclick="window.history.back();" class="cancelButton">Back</button>
    </div>
</x-app-layout>
