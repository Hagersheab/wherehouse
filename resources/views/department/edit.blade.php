<hr1>edit department</hr1>
<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ $department->name }}">
     <label for="description">description</label>
    <input type="text" name="description" id="description" value="{{ $department->description }}">
    <button type="submit">Update</button>
</form>