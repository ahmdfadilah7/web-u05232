@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Hitung Alternatif - {{ $kriteria->kriteria.' ('.$kriteria->kode_kriteria.')' }}</h5>
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

            {!! Form::open(['method' => 'post', 'route' => ['sistem.hitung.updatenilaialternatif', $kriteria->id]]) !!}
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Baris:</label>
                            <select name="kode_alternatif_1" class="form-control">
                                @foreach ($alternatif as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Kolom:</label>
                            <select name="kode_alternatif_2" class="form-control">
                                @foreach ($alternatif as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Nilai:</label>
                            <div class="d-flex">
                                <select name="nilai" class="form-control" style="margin-right:20px">
                                    @foreach ($nilai as $row)
                                        <option value="<?= $row->kepentingan ?>"><?= $row->kepentingan.' - '.$row->keterangan ?></option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary d-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach ($alternatif as $row)
                                <th>{{ $row->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = array();
                        @endphp
                        @foreach ($alternatif as $row)
                            @php
                                $matriks_sum = \App\Models\AnalisisAlternatif::where('kode_alternatif_2', $row->id)->where('kode_kriteria', $kriteria->id)->sum('nilai');
                                $total[] = $matriks_sum;
                            @endphp
                            <tr>
                                <th>{{ $row->name }}</th>
                                @php
                                    $matriks = \App\Models\AnalisisAlternatif::select('nilai')->where('kode_alternatif_1', $row->id)->where('kode_kriteria', $kriteria->id);
                                @endphp
                                @foreach ($matriks->get() as $row)
                                    <td>{{ round($row->nilai, 9) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        
                        <tr>
                            <th><strong>Total</strong></th>
                            @for ($i=0; $i < $count_alternatif; $i++)
                                <th><strong>{{ round($total[$i], 9) }}</strong></th>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('sistem.hitung.savenilaialternatif', $kriteria->id) }}" class="d-block btn btn-primary mt-2">SIMPAN HASIL PERHITUNGAN</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Nilai Eigen</h5>

            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>{{ $kriteria->kriteria.' ('.$kriteria->kode_kriteria.')' }}</th>
                            @foreach ($alternatif as $row)
                                <th>{{ $row->name }}</th>
                            @endforeach
                            <th>Jumlah</th>
                            <th>Prioritas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = array();
                        @endphp
                        @foreach ($alternatif as $row)
                            @php
                                $matriks_sum = \App\Models\AnalisisAlternatif::where('kode_alternatif_2', $row->id)->where('kode_kriteria', $kriteria->id)->sum('jumlah');
                                $total[] = $matriks_sum;
                            @endphp
                            <tr>
                                <th>{{ $row->name }}</th>
                                @php
                                    $matriks = \App\Models\AnalisisAlternatif::select('jumlah')->where('kode_alternatif_1', $row->id)->where('kode_kriteria', $kriteria->id);
                                    $totaljumlah[] = $jumlahmatriks = \App\Models\AnalisisAlternatif::select('jumlah')->where('kode_alternatif_1', $row->id)->where('kode_kriteria', $kriteria->id)->sum('jumlah');
                                    $totalrata[] = $ratarata = $jumlahmatriks/$count_alternatif;
                                @endphp
                                
                                @foreach ($matriks->get() as $row)
                                    <td>{{ round($row->jumlah, 9) }}</td>
                                @endforeach
                                
                                <td>{{ round($jumlahmatriks, 9) }}</td>
                                <td>{{ round($ratarata, 9) }}</td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <th><strong>Total</strong></th>
                            @for ($i=0; $i < $count_alternatif; $i++)
                                <th><strong>{{ round($total[$i], 9) }}</strong></th>
                            @endfor
                            <th>{{ round(array_sum($totaljumlah), 9) }}</th>
                            <th>{{ round(array_sum($totalrata), 9) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Result</h5>

            <div class="table-responsive mt-4">
                @foreach($alternatif as $row)
                    @php
                        $jumlahmatriks = \App\Models\AnalisisAlternatif::select('jumlah')->where('kode_alternatif_1', $row->id)->where('kode_kriteria', $kriteria->id)->sum('jumlah');
                        $ratarata = $jumlahmatriks/$count_alternatif;

                        $analisis = \App\Models\AnalisisAlternatif::where('kode_alternatif_1', $row->id)->where('kode_alternatif_2', $row->id)->where('kode_kriteria', $kriteria->id);                        
                    @endphp

                    @foreach($analisis->get() as $value)
                        @php
                            $nilailamdamax[] = round(round($value->bobot)*$ratarata, 9);
                        @endphp
                    @endforeach
                @endforeach

                @php
                    $nilai_lamda = array_sum($nilailamdamax);
                    $nilai_ci = ($nilai_lamda-$count_alternatif)+($count_alternatif-1);
                    $count_ri = $count_alternatif-1;
                    $nilai_cr = $nilai_ci/$nilai_ri[$count_ri];
                    if ($nilai_cr <= 0.1) {
                        $kons = 'KONSISTEN';
                    } else {
                        $kons = 'TIDAK KONSISTEN';
                    }
                @endphp
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>NILAI LAMDA MAX</th>
                            <th>{{ $nilai_lamda }}</th>
                        </tr>
                        <tr>
                            <th>NILAI CI</th>
                            <th>{{ $nilai_ci }}</th>
                        </tr>
                        <tr>
                            <th>NILAI CR</th>
                            <th>{{ round($nilai_cr, 9).' - '.$kons }}</th>
                        </tr>
                    </thead>
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
