<x-app-layout>
    <div class="interaction-container">
        <h1  class="text-2xl font-semibold mb-4">Create New Interaction</h1>

        @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
</div>

</x-app-layout>
