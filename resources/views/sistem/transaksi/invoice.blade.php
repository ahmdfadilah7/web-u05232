@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

<style type="text/css">
    body {
        margin-top: 20px;
        color: #484b51;
    }

    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #86bd68 !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #478fcc !important;
    }

    .pb-25,
    .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: rgba(121, 169, 197, .92) !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }

    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #4087d4 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #68a3d5 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }
    .text-right {
        text-align: right !important;
    }
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="card page-content container pb-4">
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6">
                        <div class="text-150">
                            <span class="text-default-d3">{{ $setting->nama_website }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-120 text-right">
                            <span class="text-default-d3">
                                {{ $invoice->kode_invoice }}
                            </span>
                        </div>
                        <div class="text-120 text-right">
                            <span class="text-default-d3">
                                {{ date('d M Y', strtotime($invoice->updated_at)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <hr class="row brc-default-l1 mx-n1 mb-4" />
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Nama Pemesan:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $invoice->nama_pelanggan }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">No. HP Pemesan:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $invoice->no_penerima }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Alamat Pemesan:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $invoice->alamat }}</span>
                        </div>                            
                    </div>
                    <div class="col-sm-6 text-right">
                        <div>
                            <span class="text-600 text-110 text-blue align-middle">{{ $setting->nama_website }}</span>
                        </div>
                        <div>
                            <span class="text-600 text-110 text-blue align-middle">{{ $setting->no_telp }}</span>
                        </div>
                        <div>
                            <span class="text-600 text-110 text-blue align-middle">{{ $setting->alamat }}</span>
                        </div>                            
                    </div>

                </div>
                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Produk</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Kuantitas</div>
                        <div class="d-none d-sm-block col-sm-2">Harga Produk</div>
                        <div class="col-2">Total</div>
                    </div>
                    <div class="text-95 text-secondary-d3">
                        @php
                            $total = array();
                        @endphp
                        @foreach ($transaksi as $key => $value)
                            @php
                                $total[$key] = $value->total;
                            @endphp
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{ ++$key }}</div>
                            <div class="col-9 col-sm-5">{{ $value->nama_barang }}</div>
                            <div class="d-none d-sm-block col-2">{{ $value->kuantitas }}</div>
                            <div class="d-none d-sm-block col-2 text-95">Rp. {{ number_format($value->harga_barang) }}</div>
                            <div class="col-2 text-secondary-d2">Rp. {{ number_format($value->total) }}</div>
                        </div>

                        @endforeach                            
                    </div>
                    <div class="row border-b-2 brc-default-l2"></div>


                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <div>
                                Metode Pembayaran
                                <p>{{ $invoice->nama_bank.' - '.$invoice->no_rekening.' A/N '.$invoice->nama_rekening }}</p>
                            </div>
                            <div>
                                Jasa Pengiriman
                                <p>{{ $invoice->jasakirim }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">                                
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Pembayaran
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">Rp. {{ number_format(array_sum($total)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div>
                        <span class="text-secondary-d1 text-105">Terimakasih sudah berbelanja di {{ $setting->nama_website }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

