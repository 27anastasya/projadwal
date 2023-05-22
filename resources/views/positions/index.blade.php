@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-success" href="{{ route('positions.create') }}"> Add Positions</a>
</div>
<table class="table">
  <thead>
    <tr style="background-color: #0000FF;">
      <th scope="col" style="color: #FFFFFF;">No</th>
      <th scope="col" style="color: #FFFFFF;">Nama</th>
      <th scope="col" style="color: #FFFFFF;">Keterangan</th>
      <th scope="col" style="color: #FFFFFF;">Singkatan</th>
      <th scope="col" style="color: #FFFFFF;">Actions</th>
    </tr>
  </thead>
  <tbody style="background-color: #D4EFDF;">
    @php $no = 1 @endphp
    @foreach ($positions as $data)
    <tr>
      <td>{{ $no ++ }}</td>
      <!-- <td>{{ $data->id }}</td> -->
      <td>{{ $data->name }}</td>
      <td>{{ $data->keterangan }}</td>
      <td>{{ $data->alias }}</td>
      <td>
        <form action="{{ route('positions.destroy',$data->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('positions.edit',$data->id) }}">Edit</a>
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