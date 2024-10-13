<x-app-layout>
    <div class="user-container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="alert-danger">
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
                <input type="text" class="editUser-control" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="editUser-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="userType">Role</label>
                <select name="userType" class="userType-select ml-2">
                    <option value="admin" {{ old('userType', $user->userType) == 'admin' ? 'selected' : '' }}>Admin
                    </option>
                    <option value="user" {{ old('userType', $user->userType) == 'user' ? 'selected' : '' }}>User
                    </option>
                    <option value="support" {{ old('userType', $user->userType) == 'support' ? 'selected' : '' }}>
                        Support</option>
                </select>
            </div>

            <button type="submit" class="confirmButton">Save</button>
            <a href="{{ route('user.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>
