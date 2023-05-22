@extends('app')
@section('content')
<form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User Name:</strong>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="User Name">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email :</strong>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password :</strong>
                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
                @error('password')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- <div class="form-group">
            <label for="manager_id">Manager:</label>
            <select name="manager_id" id="manager_id" class="form-select">
                <option value="">Pilih</option>
                @foreach ($managers as $manager)
                <option value="{{ $manager->id}}" {{ ($manager->id == $user->manager_id) ? 'selected' : '' }}>{{ $manager->name }}</option>
                @endforeach
            </select>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Position :</strong>
                <input type="number" name="position" class="form-control" placeholder="Position" value="{{ $user->position }}">
                @error('position')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departement :</strong>
                <input type="number" name="departement" class="form-control" placeholder="Departements" value="{{ $user->departement }}">
                @error('departement')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection