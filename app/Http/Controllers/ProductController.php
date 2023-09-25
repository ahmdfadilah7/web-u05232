<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Menampilkan halaman product
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

        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as kategori')
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('product.index', compact('setting', 'kategori', 'transaksiCount', 'barang'));
    }

    // Menampilkan halaman product category
    public function category($slug)
    {
        $slug_nama = str_replace('-', ' ', $slug);
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

        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as kategori')
            ->where('kategoris.name', 'LIKE', '%'.$slug_nama.'%')
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('product.index', compact('setting', 'kategori', 'transaksiCount', 'barang'));
    }

    // Menampilkan halaman product search
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $slug_nama = str_replace('-', ' ', $keyword);
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

        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as kategori')
            ->where('barangs.nama_barang', 'LIKE', '%'.$slug_nama.'%')
            ->orWhere('kategoris.name', 'LIKE', '%'.$slug_nama.'%')
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('product.index', compact('setting', 'kategori', 'transaksiCount', 'barang'));
    }
}
