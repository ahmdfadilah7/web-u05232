@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pegawai</h5>
            {!! Form::model($pegawai, ['method' => 'post', 'route' => ['sistem.pegawai.update', $pegawai->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}">
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Foto Sebelumnya</label><br>
                    @if($pegawai->foto <> '')
                        <img src="{{ url($pegawai->foto) }}" width="50"><br>
                    @else
                        <img src="{{ url('images/user-1.jpg') }}" width="50"><br>
                    @endif
                    <label for="" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <i class="text-danger">{{ $errors->first('foto') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $pegawai->email }}">
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="Administrator" @if($pegawai->role=='Administrator') {{ 'selected' }} @endif>Administrator</option>
                        <option value="Pegawai" @if($pegawai->role=='Pegawai') {{ 'selected' }} @endif>Pegawai</option>
                    </select>
                    <i class="text-danger">{{ $errors->first('role') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $pegawai->username }}">
                    <i class="text-danger">{{ $errors->first('username') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Password <i>(Isi jika ingin mengganti password)</i></label>
                    <input type="password" name="password" class="form-control">
                    <i class="text-danger">{{ $errors->first('password') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.pegawai') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection