<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    // Menampilkan halaman transaksi
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.transaksi.index', compact('setting'));
    }

    // proses menampilkan data kategori barang dengan datatables
    public function listData()
    {
        $data = Invoice::join('pelanggans', 'invoices.pelanggan_id', 'pelanggans.id')
        ->join('jasa_kirims', 'invoices.jasakirim_id', 'jasa_kirims.id')
        ->join('rekenings', 'invoices.rekening_id', 'rekenings.id')
        ->join('banks', 'rekenings.bank_id', 'banks.id')
        ->select(
            'invoices.*', 
            'jasa_kirims.nama as jasakirim', 
            'rekenings.nama_rekening', 
            'rekenings.no_rekening',
            'banks.nama_bank'
        );
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                if ($row->status==1) {
                    $status = '<span class="badge bg-warning">Belum dibayar</span>';
                } elseif ($row->status==2) {
                    $status = '<span class="badge bg-primary">Menunggu Konfirmasi Pembayaran</span>';
                } elseif ($row->status==3) {
                    $status = '<span class="badge bg-primary">Diproses</span>';
                } elseif ($row->status==4) {
                    $status = '<span class="badge bg-success">Selesai</span>';
                } elseif ($row->status==5) {
                    $status = '<span class="badge bg-danger">Dibatalkan</span>';
                }
                return $status;
            })
            ->addColumn('pembayaran', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $img = '<a href="'.url($pembayaran->first()->bukti_pembayaran).'" target="_blank">
                                <img src="'.url($pembayaran->first()->bukti_pembayaran).'" width="70">
                            </a>';
                } else {
                    $img = '';
                }
                return $img;
            })
            ->addColumn('total_invoice', function($row) {
                $total = 'Rp. '.number_format($row->total_invoice);
                return $total;
            })
            ->addColumn('action', function($row) {
                if ($row->status==2) {
                    $btn = '<a href="'.route('sistem.transaksi.konfirmasi', $row->id).'" class="btn btn-primary btn-sm" title="Konfirmasi" style="margin-right: 5px;">
                                <i class="ti ti-check"></i>
                            </a>';
                    $btn .= '<a href="'.route('sistem.transaksi.batalkan', $row->id).'" class="btn btn-danger btn-sm" title="Batalkan" style="margin-right: 5px;">
                                <i class="ti ti-x"></i>
                            </a>';
                } elseif ($row->status==3) {
                    $btn = '<a href="'.route('sistem.transaksi.selesai', $row->id).'" class="btn btn-success btn-sm" title="Selesaikan" style="margin-right: 5px;">
                                <i class="ti ti-check"></i>
                            </a>';
                } else {
                    $btn = '';
                }
                $btn .= '<a href="'.route('sistem.transaksi.invoice', $row->id).'" class="btn btn-info btn-sm" title="Detail Invoice">
                            <i class="ti ti-eye"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'pembayaran'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan Invoice untuk pembayaran
    public function invoice($id)
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
                ->find($id);
        $transaksi = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
                ->where('transaksis.invoice_id', $invoice->id)
                ->select('transaksis.*', 'barangs.nama_barang', 'barangs.harga_barang')
                ->get();
        return view('sistem.transaksi.invoice', compact('setting', 'invoice', 'transaksi'));
    }

    // Proses Konfirmasi
    public function konfirmasi($id)
    {
        $invoice = Invoice::find($id);
        $invoice->status = '3';
        $invoice->save();

        $pembayaran = Pembayaran::where('invoice_id', $invoice->id)->first();
        $pembayaran->status = '1';
        $pembayaran->save();

        return redirect()->route('sistem.transaksi')->with('success', 'Berhasil Konfirmasi Pembayaran.');
    }

    // Proses Selesai
    public function selesai($id)
    {
        $invoice = Invoice::find($id);
        $invoice->status = '4';
        $invoice->save();

        return redirect()->route('sistem.transaksi')->with('success', 'Berhasil selesaikan pesanan.');
    }

    // Proses Batalkan
    public function batalkan($id)
    {
        $invoice = Invoice::find($id);
        $invoice->status = '5';
        $invoice->save();

        $pembayaran = Pembayaran::where('invoice_id', $invoice->id)->first();
        $pembayaran->status = '2';
        $pembayaran->save();

        return redirect()->route('sistem.transaksi')->with('success', 'Berhasil membatalkan pesanan.');
    }
}
