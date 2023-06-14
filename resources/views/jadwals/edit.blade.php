@extends('app')
@section('content')

@method('PUT')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jadwal</div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('jadwals.update',$jadwal->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <strong>Nama Kelas:</strong>
                                    <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas">
                                    @error('nama_kelas')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Ruangan:</strong>
                                        <input type="text" name="ruangan" class="form-control" placeholder="Ruangan">
                                        @error('ruangan')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nama Dosen:</strong>
                                        <input type="text" name="nama_dosen" class="form-control" placeholder="Nama Dosen">
                                        @error('nama_dosen')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Hari:</strong>
                                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal">
                                        @error('tanggal')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
                                    <div class="col-md-10 form-group">
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan Nama Mahasiswa">
                                        @error('search')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 form-group text-center">
                                        <button class="btn btn-secondary" type="button" name="btnAdd" id="btnAdd">
                                            <i class="fa fa-plus"></i> Tambah
                                        </button>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIM</th>
                                                <th scope="col">Nama Mahasiswa</th>
                                                <th scope="col">Mata Kuliah</th>
                                                <th scope="col">Jumlah Sks</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detail">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Jumlah Mahasiswa:</strong>
                                        <input type="text" name="jml" class="form-control" placeholder="Jumlah Mahasiswa">
                                        @error('jml')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('jadwals.index') }}">Back</a>
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