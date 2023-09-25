@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Slider</h5>
            {!! Form::model($slider, ['method' => 'post', 'route' => ['sistem.slider.update', $slider->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Gambar Sebelumnya</label><br>
                    <img src="{{ url($slider->gambar) }}" width="150"><br>
                    <label for="" class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    <i class="text-danger">{{ $errors->first('gambar') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.slider') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection