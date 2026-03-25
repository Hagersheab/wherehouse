<hr1>edit category</hr1>
<form action="{{ route('categories.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ $category->name }}">
    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="{{ $category->description }}">
    <button type="submit">Update</button>
</form>