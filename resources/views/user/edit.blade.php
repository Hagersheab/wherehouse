<hr1>edit user</hr1>
<form action="{{ route('user.update', $user->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="{{ $user->email }}">
    <label for="role">Role</label>
    <select name="role" id="role">
        <option value="maneger" {{ $user->role == 'maneger' ? 'selected' : '' }}>Maneger</option>
        <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
        <option value="Head_of_Department" {{ $user->role == 'Head_of_Department' ? 'selected' : '' }}>Head of Department</option>
    </select>
    <label for="department_id">Department</label>
    <select name="department_id" id="department_id">
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
        @endforeach
    </select>
    <button type="submit">Update</button>
</form>