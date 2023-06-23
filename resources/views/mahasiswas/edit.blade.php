@extends('app')
@section('content')

@method('PUT')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Mahasiswa</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('mahasiswa.update',$mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="form-group">
                                        <strong>NIM:</strong>
                                        <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control" placeholder="NIM Mahasiswa">
                                        @error('nim')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <strong>Nama Mahasiswa:</strong>
                                    <input type="nama_mahasiswa" name="nama_mahasiswa" class="form-control" placeholder="Nama Mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}">
                                    @error('nama_mahasiswa')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('mahasiswa.index') }}">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection