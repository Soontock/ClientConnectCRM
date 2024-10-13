<x-app-layout>
    <div class="interaction-container">
        <h1 class="text-2xl font-semibold mb-4">Edit Interaction</h1>
        <form action="{{ route('interactions.update', $interactions->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="customer_id">Customer:</label>
            <select name="customer_id" required disabled>
                <option value="" disabled>Select Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ $customer->id == $interactions->customer_id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>

            <label for="date_time">Date and Time:</label>
            <input type="datetime-local" name="date_time"
                value="{{ \Carbon\Carbon::parse($interactions->date_time)->format('Y-m-d\TH:i') }}" required>

            <label for="type">Type:</label>
            <input type="text" name="type" value="{{ $interactions->type }}" required>

            <label for="notes">Notes:</label>
            <textarea name="notes">{{ $interactions->notes }}</textarea>

            <button class="confirmButton" type="submit">Log Interaction</button>
            <a href="{{ route('interactions.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>
