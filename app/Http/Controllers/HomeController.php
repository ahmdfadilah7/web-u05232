<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // Menampilkan halaman home
    public function index()
    {
        $setting = Setting::first();
        $slider = Slider::get();
        $kategori = Kategori::get();
        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as kategori')
            ->orderBy('id', 'DESC')
            ->paginate(8);
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

        return view('home.index', compact('setting', 'slider', 'kategori', 'barang', 'transaksiCount'));
    }

    // Menampilkan halaman login untuk pelanggan
    public function login()
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

        return view('auth.login', compact('setting', 'kategori', 'transaksiCount'));
    }

    // Proses login pelanggan
    public function proses_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8'
        ],[
            'required' => ':attribute wajib diisi !!',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $username = $request->get('username');
        $password = Hash::make($request->get('password'));
        if (Auth::guard('webpelanggan')->attempt($request->only('username', 'password'))) {
            return redirect()->route('home')->with('success', 'Anda Berhasil Login');
        } else {
            return back()->with('warning', 'Data yang dimasukkan tidak cocok!!')->withInput($request->all());
        }
    }

    // Menampilkan halaman register untuk pelanggan
    public function register()
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

        return view('auth.register', compact('setting', 'kategori', 'transaksiCount'));
    }

    // Proses register pelanggan
    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:pelanggans,username',
            'email' => 'required|email|unique:pelanggans,email',
            'password' => 'required|min:8|confirmed',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'jns_kelamin' => 'required',
        ],[
            'required' => ':attribute wajib diisi !!',
            'unique' => ':attribute sudah ada, silahkan coba yang lain'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Pelanggan::create([
            'name' => $request->get('nama'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'tgl_lahir' => $request->get('tgl_lahir'),
            'no_hp' => $request->get('no_hp'),
            'jns_kelamin' => $request->get('jns_kelamin'),
        ]);

        return redirect()->route('login')->with('success', 'Berhasil membuat akun baru.');
    }

    // Proses logout
    public function logout()
    {
        if (Auth::guard('webpelanggan')->check()) {
            Auth::guard('webpelanggan')->logout();
        }
        return redirect()->route('login')->with('success', 'Berhasil keluar akun.');
    }

    // Mengambil data dari tabel barang
    public function get_product($id)
    {
        $barang = Barang::find($id);

        return json_encode($barang);
    }
}
