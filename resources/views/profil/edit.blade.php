@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h2>Ubah Profil</h2>
                {!! Form::model($profil, ['method' => 'post', 'route' => ['profil.update', $profil->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $profil->name }}">
                            <i class="text-danger">{{ $errors->first('nama_penerima') }}</i>
                        </div>
                    </div>                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $profil->email }}">
                            <i class="text-danger">{{ $errors->first('email') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">No HP</label>
                            <input type="number" name="no_hp" class="form-control" value="{{ $profil->no_hp }}">
                            <i class="text-danger">{{ $errors->first('no_hp') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jns_kelamin" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="Pria" @if($profil->jns_kelamin=='Pria') {{ 'selected' }} @endif>Pria</option>
                                <option value="Wanita" @if($profil->jns_kelamin=='Wanita') {{ 'selected' }} @endif>Wanita</option>
                            </select>
                            <i class="text-danger">{{ $errors->first('jns_kelamin') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $profil->tgl_lahir }}">
                            <i class="text-danger">{{ $errors->first('tgl_lahir') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            @if(Auth::guard('webpelanggan')->user()->foto <> '' || Auth::guard('webpelanggan')->user()->foto <> null)
                                <img src="{{ url(Auth::guard('webpelanggan')->user()->foto) }}" width="150"><br>
                            @else
                                <img src="{{ url('images/no-image.png') }}" width="150"><br>
                            @endif
                            <label for="" class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                            <i class="text-danger">{{ $errors->first('foto') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $profil->username }}">
                            <i class="text-danger">{{ $errors->first('username') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Password <i>(Isi jika ingin ganti password)</i></label>
                            <input type="password" name="password" class="form-control">
                            <i class="text-danger">{{ $errors->first('password') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection