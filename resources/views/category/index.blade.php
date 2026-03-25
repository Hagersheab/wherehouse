<hr1> category </hr1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>category_id</th>
                <th>edit</th>
                <th>delete</th>
            
               
            </tr>
        </thead>
        <tbody>
              <form action="/category" method="get">
        @csrf
        <input type="text" name="search" placeholder="البحث باسم التصنيف">
        <button type="submit">Search</button>
    </form>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->category_id }}</td>
                    <td><a href="{{ route('categories.edit', $category->id) }}">Edit</a></td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>