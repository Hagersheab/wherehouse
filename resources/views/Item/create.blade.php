<hr1> create item </hr1>
<form action="{{ route('items.store') }}" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="catogory_id">Category</label>
    <select name="catogory_id" id="catogory_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Create</button>
</form>