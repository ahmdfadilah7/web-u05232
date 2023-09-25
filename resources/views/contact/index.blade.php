@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<!-- Contact Start -->
<div class="container-fluid pt-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                {!! Form::open(['method' => 'post', 'route' => ['contact.proses_add']]) !!}
                    <div class="control-group">
                        <input type="text" name="nama" class="form-control" id="name" placeholder="Masukkan nama anda" />
                        <p class="help-block text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                    <div class="control-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email anda" />
                        <p class="help-block text-danger">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="control-group">
                        <input type="text" name="subjek" class="form-control" id="subject" placeholder="Masukkan subjek anda"/>
                        <p class="help-block text-danger">{{ $errors->first('subjek') }}</p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" name="pesan" rows="8" id="message" placeholder="Masukkan pesan anda"></textarea>
                        <p class="help-block text-danger">{{ $errors->first('pesan') }}</p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                            Kirim Pesan
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $setting->alamat }}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $setting->email }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $setting->no_telp }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<iframe width="100%" height="400px" src="{{ $setting->google_map }}" frameborder="0"></iframe>

@endsection