<x-app-layout>
    <div class="customer-container">
        <h1  class="text-2xl font-semibold mb-4">Create New Customer</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="customer-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="customer-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="id_number">ID Number</label>
                <input type="text" class="customer-control" id="id_number" name="id_number" value="{{ old('id_number') }}" required>
            </div>

            <div class="form-group">
                <label for="phoneNum">Phone Number</label>
                <input type="number" class="customer-control" id="phoneNum" name="phoneNum" value="{{ old('phoneNum') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="customer-control" id="address" name="address" required>{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="customer-control" id="notes" name="notes">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="confirmButton">Create Customer</button>
            <a href="{{ route('customer.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>