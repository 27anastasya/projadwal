@extends('app')
@section('content')

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
                    <form action="{{ route('departements.update',$departement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-group">
                                        <strong>departements:</strong>
                                        <input type="text" name="name" value="{{ $departement->name }}" class="form-control" placeholder="departement name">
                                        @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <strong>location:</strong>
                                    <input type="location" name="location" class="form-control" placeholder="location" value="{{ $departement->location }}">
                                    @error('location')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="manager_id">Manager</label>
                                        <select name="manager_id" id="manager_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}" {{($manager->id == $departement->manager_id)?'selected': ''}}>{{ $manager->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                                    <a class="btn btn-danger" href="{{ route('departements.index') }}">Back</a>
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