@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-light" href="{{ route('users.exportpdf') }}"> Export</a>
    <a class="btn btn-success" href="{{ route('users.create') }}"> Add User</a>
</div>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>

            <th scope="col">Position</th>
            <th scope="col">Departement</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>

            <td>{{ $data->position }}</td>
            <td>{{ $data->departement }}</td>

            <td>
                <form action="{{ route('users.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('users.edit',$data->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection