@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h2>Edit Alamat</h2>
                {!! Form::model($alamat, ['method' => 'post', 'route' => ['profil.alamat.proses_update', $alamat->id]]) !!}
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Penerima</label>
                            <input type="text" name="nama_penerima" class="form-control" value="{{ $alamat->nama_penerima }}">
                            <i class="text-danger">{{ $errors->first('nama_penerima') }}</i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">No Penerima</label>
                            <input type="text" name="no_penerima" class="form-control" value="{{ $alamat->no_penerima }}">
                            <i class="text-danger">{{ $errors->first('no_penerima') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="7">{{ $alamat->alamat }}</textarea>
                            <i class="text-danger">{{ $errors->first('alamat') }}</i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection