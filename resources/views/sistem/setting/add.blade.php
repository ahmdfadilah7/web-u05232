@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Setting Website</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.setting.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama Website</label>
                    <input type="text" name="nama_website" class="form-control" value="{{ old('nama_website') }}">
                    <i class="text-danger">{{ $errors->first('nama_website') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                    <i class="text-danger">{{ $errors->first('no_telp') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <i class="text-danger">{{ $errors->first('logo') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    <i class="text-danger">{{ $errors->first('favicon') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Google Map</label>
                    <input type="text" name="google_map" class="form-control" value="{{ old('google_map') }}">
                    <i class="text-danger">{{ $errors->first('google_map') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <textarea name="alamat" rows="5" class="ckeditor form-control">{{ old('alamat') }}</textarea>
                    <i class="text-danger">{{ $errors->first('alamat') }}</i>
                </div>
                <div class="form-group mb-4">
                    <label for="" class="form-label">About Us</label>
                    <textarea name="about_us" rows="5" class="form-control">{{ old('about_us') }}</textarea>
                    <i class="text-danger">{{ $errors->first('about_us') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.setting') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection