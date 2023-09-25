<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Invoice;
use App\Models\JasaKirim;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Rekening;
use App\Models\Setting;
use App\Models\Transaksi;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $setting = Setting::first();
        $kategori = Kategori::get();

        $transaksi = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
            ->join('invoices', 'transaksis.invoice_id', 'invoices.id')
            ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
            ->where('invoices.status', '0')
            ->select('transaksis.*', 'barangs.nama_barang', 'barangs.foto_barang', 'barangs.harga_barang', 'invoices.kode_invoice')
            ->get();

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

        return view('cart.index', compact('setting', 'kategori', 'transaksi', 'transaksiCount'));
    }

    // Menampilkan halaman checkout
    public function checkout($inv)
    {
        $setting = Setting::first();
        $kategori = Kategori::get();

        $transaksi = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
            ->join('invoices', 'transaksis.invoice_id', 'invoices.id')
            ->where('invoices.pelanggan_id', Auth::guard('webpelanggan')->user()->id)
            ->where('invoices.status', '0')
            ->where('invoices.kode_invoice', $inv)
            ->select('transaksis.*', 'barangs.nama_barang', 'barangs.foto_barang', 'barangs.harga_barang', 'invoices.kode_invoice')
            ->get();

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

        $rekening = Rekening::join('banks', 'rekenings.bank_id', 'banks.id')
            ->select('rekenings.*', 'banks.nama_bank')
            ->get();
        
        $jasakirim = JasaKirim::get();

        return view('cart.checkout', compact('setting', 'kategori', 'alamat', 'transaksi', 'transaksiCount', 'rekening', 'jasakirim'));
    }

    // Data Alamat
    public function alamat($id)
    {
        $alamat = Alamat::find($id);

        return json_encode($alamat);
    }

    // Proses batalkan
    public function batalkan($inv)
    {
        $invoice = Invoice::where('kode_invoice', $inv)->first();
        $invoice->delete();

        return redirect()->route('home')->with('success', 'Berhasil menghapus pesanan.');
    }

    // Proses Checkout
    public function proses_checkout(Request $request, $kode_invoice)
    {
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required',
            'no_penerima' => 'required',
            'alamat' => 'required',
            'jasa_pengiriman' => 'required',
            'pembayaran' => 'required',
        ],[
            'required' => ':attribute wajib diisi !!!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->jasakirim_id = $request->get('jasa_pengiriman');
        $invoice->rekening_id = $request->get('pembayaran');
        $invoice->status = '1';
        $invoice->total_invoice = $request->get('total_invoice');
        $invoice->updated_at = date('Y-m-d H:i:s');
        $invoice->save();

        $pelanggan = Pelanggan::find(Auth::guard('webpelanggan')->user()->id);
        $pelanggan->nama_penerima = $request->get('nama_penerima');
        $pelanggan->no_penerima = $request->get('no_penerima');
        $pelanggan->alamat = $request->get('alamat');
        $pelanggan->save();

        return redirect()->route('keranjang.invoice_pembayaran', $kode_invoice)->with('success', 'Silahkan lakukan pembayaran');

    }

    // Menampilkan Invoice untuk pembayaran
    public function invoice_pembayaran($kode_invoice)
    {
        $setting = Setting::first();
        $invoice = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
                ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
                ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
                ->join('banks', 'rekenings.bank_id', 'banks.id')
                ->select(
                    'invoices.*', 
                    'pelanggans.nama_penerima as nama_pelanggan', 'pelanggans.no_penerima', 'pelanggans.alamat', 
                    'jasa_kirims.nama as jasakirim', 
                    'rekenings.nama_rekening', 
                    'rekenings.no_rekening',
                    'banks.nama_bank'
                )
                ->where('kode_invoice', $kode_invoice)
                ->first();
        $transaksi = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
                ->where('transaksis.invoice_id', $invoice->id)
                ->select('transaksis.*', 'barangs.nama_barang', 'barangs.harga_barang')
                ->get();
        return view('cart.invoice', compact('setting', 'invoice', 'transaksi'));
    }

    // Proses Pembayaran
    public function proses_pembayaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bukti_pembayaran' => 'required|mimes:png,jpg,jpeg,webp,svg'
        ],[
            'required' => ':attribute wajib diisi !!',
            'mimes' => 'format bukti pembayaran tidak sesuai'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $kode_invoice = $request->get('kode_invoice');
        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->status = '2';
        $invoice->save();

        $bukti = $request->file('bukti_pembayaran');
        $namabukti = 'Bukti-Pembayaran-'.$kode_invoice.'-'.Str::random(3).'.'.$bukti->extension();
        $bukti->move(public_path('images'), $namabukti);
        $buktinama = 'images/'.$namabukti;

        Pembayaran::create([
            'invoice_id' => $invoice->id,
            'bukti_pembayaran' => $buktinama,
            'status' => '0'
        ]);

        return redirect()->route('home')->with('success', 'Berhasil melakukan pembayaran.');
    }

    // Menambahkan barang ke keranjang
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'kuantitas' => 'required',
            'total_harga' => 'required'
        ],[
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $invoiceID = Invoice::where('pelanggan_id', Auth::guard('webpelanggan')->user()->id)
            ->where('status', '0');

        if ($invoiceID->count() > 0) {
            $transaksi = Transaksi::where('pelanggan_id', Auth::guard('webpelanggan')->user()->id)
                ->where('invoice_id', $invoiceID->first()->id)
                ->where('barang_id', $request->get('barang_id'));
            if ($transaksi->count() > 0) {
                $transaksiupdate = Transaksi::find($transaksi->first()->id);
                $transaksiupdate->kuantitas = $transaksi->first()->kuantitas + $request->get('kuantitas');
                $transaksiupdate->total = $transaksiupdate->kuantitas * $request->get('harga_barang');
                $transaksiupdate->save();
            } else {
                Transaksi::create([
                    'invoice_id' => $invoiceID->first()->id,
                    'barang_id' => $request->get('barang_id'),
                    'pelanggan_id' => Auth::guard('webpelanggan')->user()->id,
                    'kuantitas' => $request->get('kuantitas'),
                    'total' => $request->get('total_harga'),
                    'tanggal' => date('Y-m-d')
                ]);
            }

            return redirect()->route('keranjang')->with('success', 'Berhasil menambahkan barang ke keranjang.');
        } else {
            $kode_invoice = 'INVKJ99'.date('dmY').strtoupper(Str::random(5));            
            $invoice = new Invoice;
            $invoice->kode_invoice = $kode_invoice;
            $invoice->pelanggan_id = Auth::guard('webpelanggan')->user()->id;
            $invoice->status = '0';
            $invoice->save();

            Transaksi::create([
                'invoice_id' => $invoice->id,
                'barang_id' => $request->get('barang_id'),
                'pelanggan_id' => Auth::guard('webpelanggan')->user()->id,
                'kuantitas' => $request->get('kuantitas'),
                'total' => $request->get('total_harga'),
                'tanggal' => date('Y-m-d')
            ]);

            return redirect()->route('keranjang')->with('success', 'Berhasil menambahkan barang ke keranjang.');
        }
    }

    // Proses update kuantitas
    public function update_kuantitas(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kuantitas' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $transaksi = Transaksi::find($id);
        if ($request->get('kuantitas') > 0) {
            $transaksi->kuantitas = $request->get('kuantitas');
            $transaksi->total = $transaksi->kuantitas * $request->get('harga_barang');
            $transaksi->save();

            return redirect()->route('keranjang')->with('success', 'Berhasil menambahkan kuantitas.');

        } else {
            return redirect()->route('keranjang')->with('warning', 'Kuantitas tidak boleh kosong.');
        }
    }

    public function delete_barang($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return redirect()->route('keranjang')->with('success', 'Berhasil menghapus barang dari keranjang.');
    }
}
