@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-secondary" href="{{ route('departements.create') }}"> Add Departement</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Location</th>
            <th scope="col">Manager Id</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departements as $departement)
        <tr>
            <td>{{ $departement->id }}</td>
            <td>{{ $departement->name }}</td>
            <td>{{ $departement->location }}</td>
            <td>{{ $departement->manager_id }}</td>
            <td>
                <form action="{{ route('departements.destroy',$departement->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('departements.edit',$departement->id) }}">Edit</a>
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