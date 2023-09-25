@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative mb-3">
                <span class="bg-secondary pr-3">Menurut Anda mana yang lebih penting?</span>
            </h5>
            <div class="bg-light p-4 mb-30 text-center">

                {!! Form::open(['method' => 'post', 'route' => ['spk.filter']]) !!}
                
                @foreach($kriteria as $value)
                    <div class="mb-2">
                        <h6>
                            {{ $value->kriteria }}
                        </h6>
                        @for ($i=1; $i < 4; $i++)
                            <input type="radio" name="{{ $value->kode_kriteria }}" value="{{ $i }}"> {{ $i }}
                        @endfor
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Filter</button>

                {!! Form::close() !!}

            </div>
            <!-- Price End -->
            
        </div>

        <div class="col-md-9 col-sm-12">
            <div class="row product-lists">

                @foreach ($barang as $value)
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center {{ strtolower(str_replace(' ', '-', $value->kategori)) }}">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ url($value->foto_barang) }}" alt="">
                                <div class="product-action">
                                    <a onclick="get_menu({{ $value->id }})" class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $value->nama_barang }}</a>
                                <br>
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $value->kategori }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>Rp. {{ number_format($value->harga_barang) }}</h5>
                                </div>
                                @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                                    <a onclick="get_menu({{ $value->id }})" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Tambah Keranjang</a>
                                @endif                        
                            </div>
                        </div>
                    </div>
        
                @endforeach
                
            </div>
        
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $barang->links() }}
                </div>
            </div>
        </div>
    </div>    
</div>

@include('layouts.partials.addcart')

@endsection