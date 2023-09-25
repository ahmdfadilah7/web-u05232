<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\AnalisisAlternatif;
use App\Models\AnalisisKriteria;
use App\Models\HasilAlternatif;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\Ranking;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HitungController extends Controller
{
    // Menampilkan halaman hitung kriteria
    public function kriteria() 
    {
        $setting = Setting::first();
        $kriteria = Kriteria::get();
        $count_kriteria = Kriteria::count();
        $nilai = Nilai::get();
        $nilai_ri = array('0', '0', '58', '9', '112', '124', '132', '141', '146', '149');

        return view('sistem.hitung.kriteria', compact('setting', 'kriteria', 'nilai', 'count_kriteria', 'nilai_ri'));
    }

    // Menampilkan halaman list alternatif
    public function alternatif() 
    {
        $setting = Setting::first();
        $kriteria = Kriteria::get();
        $count_kriteria = Kriteria::count();
        $nilai = Nilai::get();
        $nilai_ri = array('0', '0', '58', '9', '112', '124', '132', '141', '146', '149');
        $ranking = Ranking::join('kategoris', 'rankings.kode_alternatif', 'kategoris.id')
            ->select('rankings.*', 'kategoris.name as alternatif')
            ->orderBy('nilai', 'DESC')
            ->get();

        return view('sistem.hitung.alternatif', compact('setting', 'kriteria', 'nilai', 'count_kriteria', 'nilai_ri', 'ranking'));
    }

    // Menampilkan halaman hitung alternatif
    public function hitung_alternatif($id)
    {
        $setting = Setting::first();
        $kriteria = Kriteria::find($id);
        $alternatif = Kategori::get();
        $count_alternatif = Kategori::count();
        $nilai = Nilai::get();
        $nilai_ri = array('0', '0', '58', '9', '112', '124', '132', '141', '146', '149');

        return view('sistem.hitung.hitungalternatif', compact('setting', 'kriteria', 'nilai', 'alternatif', 'count_alternatif', 'nilai_ri'));
    }

    // Proses update nilai kriteria
    public function update_nilai_kriteria(Request $request) {
        $kode_kriteria_1 = $request->get('kode_kriteria_1');
        $kode_kriteria_2 = $request->get('kode_kriteria_2');
        $nilai = $request->get('nilai');

        $min_kriteria = Kriteria::min('id');
        if ($kode_kriteria_1 == $min_kriteria) {
            $nilai_1 = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria_1)->where('kode_kriteria_2', $kode_kriteria_2)->first();
            $nilai_1->nilai = $nilai;
            $nilai_1->save();

            $kriteria_2 = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria_1)->where('kode_kriteria_2', $kode_kriteria_1);
            $jumlah_nilai = $kriteria_2->first()->nilai/$nilai;
            $nilai_2 = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria_2)->where('kode_kriteria_2', $kode_kriteria_1)->first();
            $nilai_2->nilai = $jumlah_nilai;
            $nilai_2->save();
        } else {
            $kriteria_2 = AnalisisKriteria::where('kode_kriteria_1', $min_kriteria)->where('kode_kriteria_2', $kode_kriteria_2);
            $jumlah_nilai = $kriteria_2->first()->nilai/$nilai;
            $nilai_2 = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria_1)->where('kode_kriteria_2', $kode_kriteria_2)->first();
            $nilai_2->nilai = $jumlah_nilai;
            $nilai_2->save();
        }

        return redirect()->route('sistem.hitung.kriteria')->with('success', 'Berhasil mengedit nilai kriteria.');
    }

    public function save_nilai_kriteria() 
    {
        $kriteria = Kriteria::get();
        $count_kriteria = Kriteria::count();
        $analisis = AnalisisKriteria::get();
        foreach ($analisis as $row) {
            $kode_kriteria_1 = $row->kode_kriteria_1;
            $kode_kriteria_2 = $row->kode_kriteria_2;
            $jumlahbobot = AnalisisKriteria::where('kode_kriteria_2', $kode_kriteria_1)->sum('nilai');
            $bobot = AnalisisKriteria::where('kode_kriteria_2', $kode_kriteria_1);
            foreach ($bobot->get() as $row) {
                $row->bobot = $jumlahbobot;
                $row->save();
            }
        }

        foreach ($analisis as $row) {
            $kode_kriteria_1 = $row->kode_kriteria_1;
            $kode_kriteria_2 = $row->kode_kriteria_2;
            $getdata = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria_1)->where('kode_kriteria_2', $kode_kriteria_2);
            foreach ($getdata->get() as $row) {
                $row->jumlah = $row->nilai/$row->bobot;
                $row->save();
            }
        }

        foreach ($kriteria as $row) {
            $kode_kriteria = $row->id;
            $jumlah = AnalisisKriteria::where('kode_kriteria_1', $kode_kriteria)->sum('jumlah');
            $nilai_kriteria = $jumlah/$count_kriteria;
            $kriteria_2 = Kriteria::where('id', $kode_kriteria);
            foreach ($kriteria_2->get() as $row) {
                $row->nilai_kriteria = $nilai_kriteria;
                $row->save();
            }
        }

        return redirect()->route('sistem.hitung.kriteria')->with('success', 'Berhasil menyimpan hasil perhitungan kriteria.');
    }

    // Proses update nilai alternatif
    public function update_nilai_alternatif(Request $request, $id) {
        $kode_alternatif_1 = $request->get('kode_alternatif_1');
        $kode_alternatif_2 = $request->get('kode_alternatif_2');
        $nilai = $request->get('nilai');

        $min_alternatif = Kategori::min('id');
        if ($kode_alternatif_1 == $min_alternatif) {
            $nilai_1 = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif_1)->where('kode_alternatif_2', $kode_alternatif_2)->where('kode_kriteria', $id)->first();
            $nilai_1->nilai = $nilai;
            $nilai_1->save();

            $alternatif_2 = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif_1)->where('kode_alternatif_2', $kode_alternatif_1)->where('kode_kriteria', $id);
            $jumlah_nilai = $alternatif_2->first()->nilai/$nilai;
            $nilai_2 = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif_2)->where('kode_alternatif_2', $kode_alternatif_1)->where('kode_kriteria', $id)->first();
            $nilai_2->nilai = $jumlah_nilai;
            $nilai_2->save();
        } else {
            $alternatif_2 = AnalisisAlternatif::where('kode_alternatif_1', $min_alternatif)->where('kode_alternatif_2', $kode_alternatif_2)->where('kode_kriteria', $id);
            $jumlah_nilai = $alternatif_2->first()->nilai/$nilai;
            $nilai_2 = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif_1)->where('kode_alternatif_2', $kode_alternatif_2)->where('kode_kriteria', $id)->first();
            $nilai_2->nilai = $jumlah_nilai;
            $nilai_2->save();
        }

        return redirect()->route('sistem.hitung.hitungalternatif', $id)->with('success', 'Berhasil mengedit nilai alternatif.');
    }

    public function save_nilai_alternatif($id) 
    {
        $alternatif = Kategori::get();
        $count_alternatif = Kategori::count();
        $analisis = AnalisisAlternatif::get();
        foreach ($analisis as $row) {
            $kode_alternatif_1 = $row->kode_alternatif_1;
            $kode_alternatif_2 = $row->kode_alternatif_2;
            $jumlahbobot = AnalisisAlternatif::where('kode_alternatif_2', $kode_alternatif_1)->where('kode_kriteria', $id)->sum('nilai');
            $bobot = AnalisisAlternatif::where('kode_alternatif_2', $kode_alternatif_1)->where('kode_kriteria', $id);
            foreach ($bobot->get() as $row) {
                $row->bobot = $jumlahbobot;
                $row->save();
            }
        }

        foreach ($analisis as $row) {
            $kode_alternatif_1 = $row->kode_alternatif_1;
            $kode_alternatif_2 = $row->kode_alternatif_2;
            $getdata = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif_1)->where('kode_alternatif_2', $kode_alternatif_2)->where('kode_kriteria', $id);
            foreach ($getdata->get() as $row) {
                $row->jumlah = $row->nilai/$row->bobot;
                $row->save();
            }
        }

        $data = array();
        $hasilalternatif = HasilAlternatif::where('kode_kriteria', $id);
        $hasilalternatif->delete();
        foreach ($alternatif as $row) {
            $kode_alternatif = $row->id;
            $jumlah = AnalisisAlternatif::where('kode_alternatif_1', $kode_alternatif)->where('kode_kriteria', $id)->sum('jumlah');
            $nilai_alternatif = $jumlah/$count_alternatif;
            array_push($data, 
                array(
                    'kode_alternatif' => $kode_alternatif,
                    'kode_kriteria' => $id,
                    'nilai_alternatif' => $nilai_alternatif
                ),
            );
        }
        HasilAlternatif::insert($data);

        return redirect()->route('sistem.hitung.hitungalternatif', $id)->with('success', 'Berhasil menyimpan hasil perhitungan alternatif.');
    }

    public function save_ranking_alternatif() 
    {
        $alternatif = Kategori::get();
        $kriteria = Kriteria::get();

        $data = array();
        foreach ($alternatif as $row) {
            foreach ($kriteria as $value) {
                $hasil = HasilAlternatif::where('kode_alternatif', $row->id)->where('kode_kriteria', $value->id);
                $nilai = $hasil->first()->nilai_alternatif*$value->nilai_kriteria;
                $totalnilai[] = $nilai;
            }
            array_push($data, 
                array(
                    'kode_alternatif' => $row->id,
                    'nilai' => array_sum($totalnilai)
                )
            );
        }

        Ranking::insert($data);

        return redirect()->route('sistem.hitung.alternatif')->with('success', 'Berhasil menyimpan hasil perhitungan alternatif.');
    }
}
