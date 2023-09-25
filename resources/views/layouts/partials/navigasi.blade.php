<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <span class="text-body">{{ $setting->email }}</span>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                <button type="button" class="btn btn-sm btn-light" disabled>{{ Auth::guard('webpelanggan')->user()->name }}</button>
                @else
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Login/Register</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                            <a href="{{ route('register') }}" class="dropdown-item" type="button">Register</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="{{ route('keranjang') }}" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">{{ $transaksiCount }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">{{ $setting->nama_website }}</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            {!! Form::open(['method' => 'get', 'route' => ['product.search']]) !!}
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Contact Us</p>
            <h5 class="m-0">{{ $setting->no_telp }}</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid bg-dark">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    {{-- <div class="nav-item dropdown dropright">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div> --}}
                    @foreach ($kategori as $value)
                        <a href="{{ route('product.category', str_replace(' ', '-', $value->name)) }}" class="nav-item nav-link ">{{ $value->name }}</a>
                    @endforeach
                 </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">{{ $setting->nama_website }}</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link @if(Request::segment(1)=='') active @endif">Home</a>
                        <a href="{{ route('product') }}" class="nav-item nav-link @if(Request::segment(1)=='product') active @endif">Product</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link @if(Request::segment(1)=='about') active @endif">About Us</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link @if(Request::segment(1)=='contact') active @endif">Contact Us</a>
                        <a href="{{ route('spk') }}" class="nav-item nav-link @if(Request::segment(1)=='spk') active @endif">SPK</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        {{-- <a href="" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a> --}}
                        @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                            <a href="{{ route('keranjang') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{ $transaksiCount }}</span>
                            </a>
                            <a href="{{ route('profil') }}" class="btn px-0 ml-3">
                                <i class="fas fa-user text-primary"></i>
                            </a>
                            <a href="{{ route('logout') }}" class="btn px-0 ml-3">
                                <i class="fas fa-sign-out-alt text-primary"></i>
                            </a>
                        @else
                            <div class="btn-group ml-3">
                                <a type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user text-primary"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">                                
                                    <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                                    <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->