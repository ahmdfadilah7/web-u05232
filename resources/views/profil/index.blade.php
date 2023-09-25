@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between">
                    <h3>Profil {{ Auth::guard('webpelanggan')->user()->name }}</h3>
                    <a href="{{ route('profil.ubah', Auth::guard('webpelanggan')->user()->id) }}" class="btn btn-primary">Ubah Profil</a>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        @if(Auth::guard('webpelanggan')->user()->foto <> '' || Auth::guard('webpelanggan')->user()->foto <> null)
                            <img src="{{ url(Auth::guard('webpelanggan')->user()->foto) }}" width="250">
                        @else
                            <img src="{{ url('images/no-image.png') }}" width="250" height="300">
                        @endif
                    </div>
                    <div class="col-md-9">

                        <table style="width:100%;">
                            <tr>
                                <th style="width: 20%"><h6>Nama Lengkap</h6></th>
                                <td><h6>{{ Auth::guard('webpelanggan')->user()->name }}</h6></td>
                            </tr>
                            <tr>
                                <th style="width: 20%"><h6>Username</h6></th>
                                <td><h6>{{ Auth::guard('webpelanggan')->user()->username }}</h6></td>
                            </tr>
                            <tr>
                                <th style="width: 20%"><h6>Jenis Kelamin</h6></th>
                                <td><h6>{{ Auth::guard('webpelanggan')->user()->jns_kelamin }}</h6></td>
                            </tr>
                            <tr>
                                <th style="width: 20%"><h6>Tanggal Lahir</h6></th>
                                <td><h6>{{ date('d M Y', strtotime(Auth::guard('webpelanggan')->user()->tgl_lahir)) }}</h6></td>
                            </tr>
                            <tr>
                                <th style="width: 20%"><h6>No Hanphone</h6></th>
                                <td><h6>{{ Auth::guard('webpelanggan')->user()->no_hp }}</h6></td>
                            </tr>
                            <tr>
                                <th style="width: 20%"><h6>Email</h6></th>
                                <td><h6>{{ Auth::guard('webpelanggan')->user()->email }}</h6></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card p-4">
                <div class="d-flex justify-content-between">
                    <h3>Alamat Pengiriman</h3>
                    <a href="{{ route('profil.alamat.add') }}" class="btn btn-primary">Tambah Alamat</a>
                </div>
                <div class="table-responsive mt-3">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penerima</th>
                                <th>No Penerima</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alamat as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->nama_penerima }}</td>
                                    <td>{{ $value->no_penerima }}</td>
                                    <td>{{ Str::substr($value->alamat, 0, 50).'...' }}</td>
                                    <td>
                                        <a href="{{ route('profil.alamat.edit', $value->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('profil.alamat.delete', $value->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card p-4">
                <div class="d-flex justify-content-between">
                    <h3>Pesanan</h3>
                    <a href="{{ route('home') }}" class="btn btn-primary">Tambah Pesanan</a>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-black-50" id="belumdibayar-tab" data-toggle="tab" href="#belumdibayar" role="tab" aria-controls="belumdibayar" aria-selected="true">
                            Belum dibayar
                            <span class="badge text-black-50 border border-primary rounded-circle" style="padding-bottom: 2px;">{{ $pesananbelumdibayarCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black-50" id="menunggukonfirmasi-tab" data-toggle="tab" href="#menunggukonfirmasi" role="tab" aria-controls="menunggukonfirmasi" aria-selected="false">
                            Menunggu Konfirmasi Pembayaran
                            <span class="badge text-black-50 border border-primary rounded-circle" style="padding-bottom: 2px;">{{ $pesananmenunggukonfirmasiCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black-50" id="diproses-tab" data-toggle="tab" href="#diproses" role="tab" aria-controls="diproses" aria-selected="false">
                            Diproses
                            <span class="badge text-black-50 border border-primary rounded-circle" style="padding-bottom: 2px;">{{ $pesanandiprosesCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black-50" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">
                            Selesai
                            <span class="badge text-black-50 border border-primary rounded-circle" style="padding-bottom: 2px;">{{ $pesananselesaiCount }}</span>
                        </a>
                      </li>
                    <li class="nav-item">
                        <a class="nav-link text-black-50" id="dibatalkan-tab" data-toggle="tab" href="#dibatalkan" role="tab" aria-controls="dibatalkan" aria-selected="false">
                            Dibatalkan
                            <span class="badge text-black-50 border border-primary rounded-circle" style="padding-bottom: 2px;">{{ $pesanandibatalkanCount }}</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="belumdibayar" role="tabpanel" aria-labelledby="belumdibayar-tab">
                        <div class="table-responsive mt-3">
                            <table id="example1" class="example1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Invoice</th>
                                        <th>Jasa Kirim</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesananbelumdibayar as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->kode_invoice }}</td>
                                            <td>{{ $value->jasakirim }}</td>
                                            <td>{{ $value->nama_bank }}</td>
                                            <td>
                                                @if($value->status==1)
                                                    <span class="badge badge-warning">Belum dibayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($value->total_invoice) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('keranjang.invoice_pembayaran', $value->kode_invoice) }}" class="btn btn-primary btn-sm">BAYAR</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="menunggukonfirmasi" role="tabpanel" aria-labelledby="menunggukonfirmasi-tab">
                        <div class="table-responsive mt-3">
                            <table id="example1" class="example1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Invoice</th>
                                        <th>Jasa Kirim</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesananmenunggukonfirmasi as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->kode_invoice }}</td>
                                            <td>{{ $value->jasakirim }}</td>
                                            <td>{{ $value->nama_bank }}</td>
                                            <td>
                                                @if($value->status==2)
                                                    <span class="badge badge-info">Menunggu Konfirmasi Pembayaran</span>
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($value->total_invoice) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                        <div class="table-responsive mt-3">
                            <table id="example1" class="example1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Invoice</th>
                                        <th>Jasa Kirim</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanandiproses as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->kode_invoice }}</td>
                                            <td>{{ $value->jasakirim }}</td>
                                            <td>{{ $value->nama_bank }}</td>
                                            <td>
                                                @if($value->status==3)
                                                    <span class="badge badge-info">Pesanan sedang diproses</span>
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($value->total_invoice) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                        <div class="table-responsive mt-3">
                            <table id="example1" class="example1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Invoice</th>
                                        <th>Jasa Kirim</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesananselesai as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->kode_invoice }}</td>
                                            <td>{{ $value->jasakirim }}</td>
                                            <td>{{ $value->nama_bank }}</td>
                                            <td>
                                                @if($value->status==4)
                                                    <span class="badge badge-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($value->total_invoice) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
                        <div class="table-responsive mt-3">
                            <table id="example1" class="example1 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Invoice</th>
                                        <th>Jasa Kirim</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanandibatalkan as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->kode_invoice }}</td>
                                            <td>{{ $value->jasakirim }}</td>
                                            <td>{{ $value->nama_bank }}</td>
                                            <td>
                                                @if($value->status==5)
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($value->total_invoice) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#example1').DataTable();
            $('.example1').DataTable();
        });
    </script>

@endsection