@extends('Layout/user/main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">User List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                   
                    <!-- Add more table cells based on your user attributes -->
                </tr>
            
        </tbody>
    </table>
</div>

@endsection