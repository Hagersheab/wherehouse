<hr1> item </hr1>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>edit</th>
            <th>delete</th>
        
           
        </tr>
    </thead>
    <tbody>
          <form action="/item" method="get">
        @csrf
        <input type="text" name="search" placeholder="البحث باسم الصنف">
        <button type="submit">Search</button>
    </form>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><a href="{{ route('items.edit', $item->id) }}">Edit</a></td>
                <td>
                    <form action="{{ route('items.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            
        @endforeach
    </tbody>
</table>