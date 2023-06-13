@extends('app')
@section('content')
<form action="{{ route('positions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Position</div>
                    <div class="card-body">
                        <div class="card">
                            <div class="row g-3">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                        @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Keterangan:</strong>
                                        <input type="keterangan" name="keterangan" class="form-control" placeholder="Keterangan">
                                        @error('keterangan')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Alias</strong>
                                        <input type="text" name="alias" class="form-control" placeholder="Alias">
                                        @error('alias')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                                <a class="btn btn-danger" href="{{ route('positions.index') }}">Back</a>
                            </div>
</form>
@endsection