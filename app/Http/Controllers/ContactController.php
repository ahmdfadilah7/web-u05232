<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    // Menampilkan halaman contact us
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

        return view('contact.index', compact('setting', 'kategori', 'transaksiCount'));
    }

    // Proses contact us
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'subjek' => 'required',
            'pesan' => 'required'
        ],[
            'required' => ':attribute wajib diisi !!!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Contact::create([
            'nama_pengirim' => $request->get('nama'),
            'email_pengirim' => $request->get('email'),
            'subjek_pengirim' => $request->get('subjek'),
            'pesan' => $request->get('pesan'),
        ]);

        return redirect()->route('contact')->with('success', 'Terimakasih sudah memberikan ulasan kepada kami.');
    }
}
