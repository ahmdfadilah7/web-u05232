@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Jasa Kirim</h5>
            {!! Form::model($jasakirim, ['method' => 'post', 'route' => ['sistem.jasakirim.update', $jasakirim->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $jasakirim->nama }}">
                    <i class="text-danger">{{ $errors->first('nama') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.jasakirim') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection