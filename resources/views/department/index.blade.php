<!-- <h1>Department</h1>
<a href="{{ route('departments.create') }}">Create Department</a>
             <form action="/department" method="get">
        @csrf
        <input type="text" name="search" placeholder="search by department name">
        <button type="submit">Search</button>
    </form>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>description</th>
        <th>Action</th>
            <th>edit</th>
                <th>delete</th>
    </tr>
    @foreach ($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->description }}</td>
            <td>
                <a href="{{ route('departments.edit', $department->id) }}">Edit</a>
                <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table> -->

<hr1> department </hr1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>description</th>
                <th>edit</th>
                <th>delete</th>
            
               
            </tr>
        </thead>
        <tbody>
              <form action="/department" method="get">
        @csrf
        <input type="text" name="search" placeholder="البحث باسم القسم">
        <button type="submit">Search</button>
    </form>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td><a href="{{ route('departments.edit', $department->id) }}">Edit</a></td>
                    <td>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>