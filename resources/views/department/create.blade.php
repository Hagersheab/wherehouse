<hr1>create department</hr1>
<form action="{{ route('departments.store') }}" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    <button type="submit">Create</button>
</form>