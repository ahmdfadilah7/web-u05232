<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class AboutController extends Controller
{
    // Menampilkan halaman about us
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

        return view('about.index', compact('setting', 'kategori', 'transaksiCount'));
    }
}
