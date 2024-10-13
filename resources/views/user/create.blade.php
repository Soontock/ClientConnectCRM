<x-app-layout>
    <div class="user-container">
        <h1>Create New User</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name">User Name</label>
                <input type="text" class="create-control" id="name" name="name" value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" class="create-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" class="create-control" id="password" name="password"
                    value="{{ old('password') }}" required>
            </div>

            <div class="mb-4">
                <label for="userType">Role</label>
                <select name="userType" class="userType-select ml-2">
                    <option value="admin" {{ request()->input('userType') == 'admin' ? 'selected' : '' }}>Admin
                    </option>
                    <option value="user" {{ request()->input('userType') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="support" {{ request()->input('userType') == 'support' ? 'selected' : '' }}>Support
                    </option>
                </select>
            </div>

            <button type="submit" class="confirmButton">Create User</button>
            <a href="{{ route('user.index') }}" class="cancelButton">Cancel</a>
        </form>
    </div>
</x-app-layout>
