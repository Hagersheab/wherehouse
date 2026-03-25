<hr1> users </hr1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department ID</th>
                <th>Edit</th>
            
            
               
            </tr>
        </thead>
        <tbody>
              <form action="/user" method="get">
        @csrf
        <input type="text" name="search" placeholder="البحث باسم المستخدم">
        <button type="submit">Search</button>
    </form>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->department->name }}</td>
                    <td><a href="{{ route('user.edit', $user->id) }}">Edit</a></td>
                    
                </tr>
                
            @endforeach
        </tbody>
    </table>