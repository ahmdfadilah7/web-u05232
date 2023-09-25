@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid pt-3">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    
                    @foreach ($transaksi as $value)
                        
                        <tr>
                            <td class="align-middle"><img src="{{ url($value->foto_barang) }}" style="width: 50px;"> {{ $value->nama_barang }}</td>
                            <td class="align-middle">Rp. {{ number_format($value->harga_barang) }}</td>
                            <td class="align-middle">
                                {!! Form::open(['method' => 'post', 'route' => ['keranjang.updatekuantitas', $value->id]]) !!}
                                <input type="hidden" name="harga_barang" value="{{ $value->harga_barang }}">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="kuantitas" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $value->kuantitas }}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">update</button>
                                {!! Form::close() !!}
                            </td>
                            <td class="align-middle">Rp. {{ number_format($value->total) }}</td>
                            <td class="align-middle"><a href="{{ route('keranjang.hapusbarang', $value->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                        </tr>
                        
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5> --}}
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    @php
                        $total = array();
                        $kode_invoice = '';
                    @endphp
                    @foreach ($transaksi as $key => $value)
                        @php
                            $total[$key] = $value->total;
                            $kode_invoice = $value->kode_invoice;
                        @endphp
                        <div class="d-flex justify-content-between mb-3">
                            <h6>{{ $value->nama_barang }}</h6>
                            <h6>{{ $value->kuantitas }}</h6>
                            <h6>Rp. {{ number_format($value->total) }}</h6>
                        </div>

                    @endforeach
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>Rp. {{ number_format(array_sum($total)) }}</h5>
                    </div>
                    @if($transaksiCount > 0)
                        <a href="{{ route('keranjang.checkout', $kode_invoice) }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-block btn-info font-weight-bold my-3 py-3">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection