<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProfilController extends Controller
{
    // Menampilkan halaman profil
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

        $alamat = Alamat::where('pelanggan_id', Auth::guard('webpelanggan')->user()->id)->get();

        $pesananbelumdibayar = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('status', '1')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->get();
        $pesananbelumdibayarCount = Invoice::where('status', '1')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->count();

        $pesananmenunggukonfirmasi = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('status', '2')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->get();
        $pesananmenunggukonfirmasiCount = Invoice::where('status', '2')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->count();
        $pesanandiproses = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('status', '3')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->get();
        $pesanandiprosesCount = Invoice::where('status', '3')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->count();
        $pesananselesai = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('status', '4')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->get();
        $pesananselesaiCount = Invoice::where('status', '4')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->count();
        $pesanandibatalkan = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('status', '5')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->get();
        $pesanandibatalkanCount = Invoice::where('status', '5')
                ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->count();

        return view('profil.index', 
        compact(
            'setting', 
            'kategori', 
            'alamat', 
            'pesananbelumdibayar', 
            'pesananbelumdibayarCount', 
            'pesananmenunggukonfirmasi', 
            'pesananmenunggukonfirmasiCount',
            'pesanandiproses', 
            'pesanandiprosesCount',
            'pesananselesai', 
            'pesananselesaiCount',
            'pesanandibatalkan', 
            'pesanandibatalkanCount',
            'transaksiCount'
        ));
    }

    // Menampilkan halaman ubah profil
    public function ubah_profil($id)
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

        $profil = Pelanggan::find(Auth::guard('webpelanggan')->user()->id);

        return view('profil.edit', compact('setting', 'kategori', 'transaksiCount', 'profil'));
    }

    // Prose mengubah profil
    public function proses_ubah_profil(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'foto' => 'mimes:png,jpg,jpeg,svg,webp',
            'jns_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'username' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Profil-'.str_replace(' ', '-', $request->get('name')).'-'.Str::random(5).'.'.$foto->extension();
            $foto->move(public_path('images'), $namafoto);
            $fotoNama = 'images/'.$namafoto;
        }

        $profil = Pelanggan::find($id);
        $profil->name = $request->get('name');
        $profil->email = $request->get('email');
        $profil->no_hp = $request->get('no_hp');
        $profil->jns_kelamin = $request->get('jns_kelamin');
        $profil->tgl_lahir = $request->get('tgl_lahir');
        $profil->username = $request->get('username');
        if ($request->password <> '') {
            $profil->password = Hash::make($request->get('password'));
        }
        if ($request->foto <> '') {
            $profil->foto = $fotoNama;
        }
        $profil->save();

        return redirect()->route('profil')->with('success', 'Berhasil mengubah profil.');
    }

    // Menampilkan halaman tambah alamat
    public function alamat_add()
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

        return view('profil.alamat_add', compact('setting', 'kategori', 'transaksiCount'));
    }

    // Proses menambahkan alamat
    public function alamat_proses_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_penerima' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Alamat::create([
            'pelanggan_id' => Auth::guard('webpelanggan')->user()->id,
            'nama_penerima' => $request->get('nama_penerima'),
            'no_penerima' => $request->get('no_penerima'),
            'alamat' => $request->get('alamat'),
        ]);

        return redirect()->route('profil')->with('success', 'Berhasil menambahkan alamat.');
    }
    
    // Menampilkan halaman edit alamat
    public function alamat_edit($id)
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
        $alamat = Alamat::find($id);

        return view('profil.alamat_edit', compact('setting', 'kategori', 'alamat', 'transaksiCount'));
    }

    // Proses mengupdate alamat
    public function alamat_proses_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_penerima' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $alamat = Alamat::find($id);
        $alamat->nama_penerima = $request->get('nama_penerima');
        $alamat->no_penerima = $request->get('no_penerima');
        $alamat->alamat = $request->get('alamat');
        $alamat->save();

        return redirect()->route('profil')->with('success', 'Berhasil mengupdate alamat.');
    }

    // Proses menghapus alamat
    public function alamat_delete($id)
    {
        $alamat = Alamat::find($id);
        $alamat->delete();

        return redirect()->route('profil')->with('success', 'Berhasil menghapus alamat.');
    }
}
