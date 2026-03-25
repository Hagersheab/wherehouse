<hr1> edit item </hr1>
<form action="{{ route('items.update', $item->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ $item->name }}">
    <label for="catogory_id">Category</label>
    <select name="catogory_id" id="catogory_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $item->catogory_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Update</button>
</form>