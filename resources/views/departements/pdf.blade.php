@extends('layout')
@section('content')
<table class="table mt-5">
  <thead>
    <tr style="background-color: #0000FF;">
      <th scope="col" style="color: #FFFFFF;">No</th>
      <th scope="col" style="color: #FFFFFF;">Nama</th>
      <th scope="col" style="color: #FFFFFF;">Keterangan</th>
      <th scope="col" style="color: #FFFFFF;">Manager_id</th>
      <!-- <th scope="col" style="color: #FFFFFF;">Actions</th> -->
    </tr>
  </thead>
  <tbody style="background-color: #D4EFDF;">
    @php $no = 1 @endphp
    @foreach ($departements as $data)
    <tr>
      <td>{{ $no ++ }}</td>
      <!-- <td>{{ $data->id }}</td> -->
      <td>{{ $data->name }}</td>
      <td>{{ $data->location }}</td>
      <td>{{
        (isset($data->manager->name))?
      $data->manager->name : 
    'Tidak Ada'}}</td>
      <!-- <td>
        <form action="{{ route('departements.destroy',$data->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('departements.edit',$data->id) }}">Edit</a>
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td> -->
    </tr>
    @endforeach
  </tbody>
</table>
@endsection