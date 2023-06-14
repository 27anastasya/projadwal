@extends('app')
@section('content')
<form action="{{ route('positions.update',$position->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Departement</div>
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
                        <div class="col-md-10">
                            <div class="form-group">
                                <strong>Position Name:</strong>
                                <input type="text" name="name" value="{{ $position->name }}" class="form-control" placeholder="Position name">
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <strong>Keterangan:</strong>
                                <input type="keterangan" name="keterangan" class="form-control" placeholder="keterangan" value="{{ $position->keterangan }}">
                                @error('keterangan')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <strong>Singkatan:</strong>
                                <input type="text" name="alias" value="{{ $position->alias }}" class="form-control" placeholder="alias">
                                @error('alias')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
                            <a class="btn btn-danger mt-3" href="{{ route('positions.index') }}">Back</a>
                        </div>
                    </div>
</form>
@endsection