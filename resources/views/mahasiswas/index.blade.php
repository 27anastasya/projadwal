@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-light" href="{{ route('exportpdf') }}"> Export</a>
  <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Add Mahasiswa</a>
</div>
<table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama Mahasiswa</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1; @endphp
    @foreach ($mahasiswas as $data)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $data->nim }}</td>
      <td>{{ $data->nama_mahasiswa }}</td>
      <td>
        <form action="{{ route('mahasiswa.destroy', $data->id) }}" method="POST">
          <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $data->id) }}">Edit</a>
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

