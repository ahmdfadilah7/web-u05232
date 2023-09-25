@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Hitung Alternatif</h5>
            @if($msg = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif ($msg = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Kode Kriteria</th>
                            <th>Kriteria</th>
                            <th>Hitung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $row)
                            <tr>
                                <td>{{ $row->kode_kriteria }}</td>
                                <td>{{ $row->kriteria }}</td>
                                <td>
                                    <a href="{{ route('sistem.hitung.hitungalternatif', $row->id) }}" class="btn btn-primary btn-sm"><i class="ti ti-arrow-right"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('sistem.hitung.saverankingalternatif') }}" class="d-block btn btn-primary mt-2">SIMPAN HASIL NILAI AKHIR ALTERNATIF</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Hasil Akhir Perhitungan Alternatif</h5>

            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Nilai</th>
                            <th>Rangking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($ranking as $row)
                            <tr>
                                <td>{{ $row->alternatif }}</td>
                                <td>{{ $row->nilai }}</td>
                                <td>
                                    @if($no == 1)
                                        {{ 'Pertama' }}
                                    @else
                                        {{ $no }}
                                    @endif
                                </td>
                            </tr>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $('#example1').DataTable({
            ordering: false
        });
    </script>

@endsection
