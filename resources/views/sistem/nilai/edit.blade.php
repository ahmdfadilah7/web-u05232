@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Nilai</h5>
            {!! Form::model($nilai, ['method' => 'post', 'route' => ['sistem.nilai.update', $nilai->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Intensitas Kepentingan</label>
                    <input type="number" name="intensitas_kepentingan" class="form-control" value="{{ $nilai->kepentingan }}">
                    <i class="text-danger">{{ $errors->first('intensitas_kepentingan') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $nilai->keterangan }}">
                    <i class="text-danger">{{ $errors->first('keterangan') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.nilai') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection