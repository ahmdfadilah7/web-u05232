<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HasilAlternatif;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class SpkController extends Controller
{
    // Menampilkan halaman spk produk
    public function index() 
    {
        $setting = Setting::first();
        $kategori = Kategori::get();
        if (Str::length(Auth::guard('webpelanggan')->user()) > 0) {
            $cekinvoice = Invoice::where('pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->where('status', '0');
            if ($cekinvoice->count() > 0) {
                $transaksiCount = Transaksi::where('invoice_id', $cekinvoice->first()->id)->count();
            } else {
                $transaksiCount = 0;
            }
        } else {
            $transaksiCount = 0;
        }

        $kriteria = Kriteria::get();
        $nilai = Nilai::get();
        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as kategori')
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('spk.index', compact('setting', 'kategori', 'transaksiCount', 'barang', 'kriteria', 'nilai'));
    }

    public function filter(Request $request) 
    {
        $setting = Setting::first();
        $kategori = Kategori::get();
        if (Str::length(Auth::guard('webpelanggan')->user()) > 0) {
            $cekinvoice = Invoice::where('pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->where('status', '0');
            if ($cekinvoice->count() > 0) {
                $transaksiCount = Transaksi::where('invoice_id', $cekinvoice->first()->id)->count();
            } else {
                $transaksiCount = 0;
            }
        } else {
            $transaksiCount = 0;
        }

        $kriteria = Kriteria::get();
        $nilai = Nilai::get();

        $no = 1;
        foreach ($kriteria as $row) {
            $inputkriteria = $request->get($row->kode_kriteria);
            if ($inputkriteria==1) {

                $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
                    ->select('barangs.*', 'kategoris.name as kategori')
                    ->orderBy('id', 'ASC')
                    ->paginate(9);
            }
            if ($inputkriteria==2) {
                $min_hasil = HasilAlternatif::where('kode_kriteria', $row->id)->min('nilai_alternatif');                
                $nilai_alternatif = HasilAlternatif::where('kode_kriteria', $row->id)->where('nilai_alternatif', $min_hasil);
                
                $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
                    ->select('barangs.*', 'kategoris.name as kategori')
                    ->where('kategori_id', '<>', $nilai_alternatif->first()->kode_alternatif)
                    ->orderBy('id', 'ASC')
                    ->paginate(9);
            } elseif ($inputkriteria==3) {
                $min_hasil = HasilAlternatif::where('kode_kriteria', $row->id)->min('nilai_alternatif');                
                $nilai_alternatif = HasilAlternatif::where('kode_kriteria', $row->id)->where('nilai_alternatif', $min_hasil);
                
                $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
                    ->select('barangs.*', 'kategoris.name as kategori')
                    ->where('kategori_id', '<>', $nilai_alternatif->first()->kode_alternatif)
                    ->orderBy('id', 'DESC')
                    ->paginate(9);
            }
            $no++;
        }

        return view('spk.index', compact('setting', 'kategori', 'transaksiCount', 'barang', 'kriteria', 'nilai'));
    }
}
