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
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Alamat Pengiriman</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                {!! Form::open(['method' => 'post', 'route' => ['keranjang.prosescheckout', Request::segment(3)]]) !!}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Pilih Alamat</label>
                        <select name="check_alamat" id="alamat" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($alamat as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_penerima }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nama Penerima</label>
                        <input name="nama_penerima" id="namaPenerima" class="form-control" type="text" readonly>
                        <i class="text-danger">{{ $errors->first('nama_penerima') }}</i>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nomor Telpon</label>
                        <input name="no_penerima" id="noPenerima" class="form-control" type="text" readonly>
                        <i class="text-danger">{{ $errors->first('no_penerima') }}</i>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamatPenerima" class="form-control" rows="7" readonly></textarea>
                        <i class="text-danger">{{ $errors->first('alamat') }}</i>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Jasa Pengiriman</label>
                        <select name="jasa_pengiriman" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($jasakirim as $value)
                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger">{{ $errors->first('jasa_pengiriman') }}</i>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Pembayaran</label>
                        <select name="pembayaran" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($rekening as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_bank.' - '.$value->no_rekening.' - '.$value->nama_rekening }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger">{{ $errors->first('pembayaran') }}</i>
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Total Pembelanjaan</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    @php
                        $total = array();
                    @endphp
                    @foreach ($transaksi as $key => $value)
                        @php
                            $total[$key] = $value->total;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <p>{{ $value->nama_barang }}</p>
                            <p>{{ $value->kuantitas }}</p>
                            <p>Rp. {{ number_format($value->total) }}</p>
                        </div>

                    @endforeach
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <input type="hidden" name="total_invoice" value="{{ array_sum($total) }}">
                        <h5>Rp. {{ number_format(array_sum($total)) }}</h5>
                    </div>
                </div>
                <div class="pt-2">
                    <button class="btn btn-block btn-primary font-weight-bold py-3">BAYAR SEKARANG</button>
                    {!! Form::close() !!}
                    <a href="{{ route('keranjang.batalkan', Request::segment(3)) }}" class="btn btn-block btn-danger font-weight-bold py-3">HAPUS</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->

@endsection

@section('script')

    <script>
        $('#alamat').on('change', function(){
            var id = $('#alamat').val();
            var url = '{{ url("alamat") }}/'+id;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#namaPenerima').val(data.nama_penerima)
                    $('#noPenerima').val(data.no_penerima)
                    $('#alamatPenerima').val(data.alamat)
                }
            });
        });
    </script>

@endsection