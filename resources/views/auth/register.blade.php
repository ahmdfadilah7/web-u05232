@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container form-register pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light p-5">
                <h2 class="text-center">Register</h2>
                {!! Form::open(['method' => 'post', 'route' => ['prosesRegister']]) !!}
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                            <i class="text-danger">{{ $errors->first('nama') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                            <i class="text-danger">{{ $errors->first('username') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                            <i class="text-danger">{{ $errors->first('email') }}</i>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <i class="text-danger">{{ $errors->first('password') }}</i>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Password Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            <i class="text-danger">{{ $errors->first('password') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}">
                            <i class="text-danger">{{ $errors->first('tgl_lahir') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">No HP</label>
                            <input type="number" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                            <i class="text-danger">{{ $errors->first('no_hp') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jns_kelamin" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                            <i class="text-danger">{{ $errors->first('jns_kelamin') }}</i>
                        </div>
                    </div>                 
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection