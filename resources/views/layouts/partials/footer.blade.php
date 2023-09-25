<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-7 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">{{ $setting->nama_website }}</h5>
            <p class="mb-4">{!! $setting->about_us !!}</p>            
        </div>
        <div class="col-lg-5 col-md-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Menu</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Product</a>
                        <a class="text-secondary mb-2" href="{{ route('about') }}"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                        <a class="text-secondary mb-2" href="{{ route('contact') }}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Contact Us</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <div class="mb-2">{!! $setting->alamat !!}</div>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $setting->email }}</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $setting->no_telp }}</p>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-12 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="{{ route('home') }}">{{ $setting->nama_website }}</a>. All Rights Reserved. 
            </p>
        </div>
    </div>
</div>
<!-- Footer End -->