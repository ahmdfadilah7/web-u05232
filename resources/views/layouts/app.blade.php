<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $setting->nama_website }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $setting->nama_website }}" name="keywords">
    <meta content="{{ $setting->nama_website }}" name="description">

    <!-- Favicon -->
    <link href="{{ url($setting->favicon) }}" rel="icon">

    {{-- CSS --}}
    @yield('css')
    {{-- End CSS --}}
</head>

<body>
    
    {{-- Navigasi --}}
    @include('layouts.partials.navigasi')
    {{-- End Navigasi --}}


    {{-- Content --}}
    @yield('content')
    {{-- End Content --}}

    {{-- Footer --}}
    @include('layouts.partials.footer')
    {{-- End Footer --}}

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    {{-- Js --}}
    @yield('js')
    {{-- End Js --}}

    {{-- Script js --}}
    @yield('script')
    {{-- Script js --}}
</body>

</html>