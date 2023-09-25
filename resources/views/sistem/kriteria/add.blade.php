@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Kriteria</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.kriteria.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Kode Kriteria</label>
                    <input type="text" name="kode_kriteria" class="form-control" value="{{ $kode_kriteria }}" readonly>
                    <i class="text-danger">{{ $errors->first('kode_kriteria') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Kriteria</label>
                    <input type="text" name="kriteria" class="form-control" value="{{ old('kriteria') }}">
                    <i class="text-danger">{{ $errors->first('kriteria') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.kriteria') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection