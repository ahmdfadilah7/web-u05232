@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<!-- Contact Start -->
<div class="container-fluid pt-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">About {{ $setting->nama_website }}</span></h2>
    <div class="row px-xl-5">

        <div class="col-lg-12 mb-5">
            <div class="bg-light p-30">
                {!! $setting->about_us !!}
            </div>
        </div>
        
    </div>
</div>
@endsection