<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class BankController extends Controller
{
    // Menampilkan halaman setting website
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.bank.index', compact('setting'));
    }

    // proses menampilkan data bank dengan datatables
    public function listData()
    {
        $data = Bank::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()     
            ->addColumn('logo_bank', function($row) {
                if ($row->logo_bank <> '') {
                    $img = '<img src="'.url($row->logo_bank).'" width="70">';
                } else {
                    $img = '';
                }
                return $img;
            })       
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.bank.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.bank.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo_bank'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah bank
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.bank.add', compact('setting'));
    }

    // Proses menambahkan data bank ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required',
            'logo_bank' => 'required|mimes:jpg,jpeg,svg,png,gif,webp',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $foto = $request->file('logo_bank');
        $namafoto = 'Bank-'.str_replace(' ', '-', $request->get('nama_bank')).'-'.Str::random(4).'.'.$foto->extension();
        $tujuan = 'images';
        $foto->move(public_path($tujuan), $namafoto);
        $fotoNama = $tujuan.'/'.$namafoto;

        Bank::create([
            'nama_bank' => $request->get('nama_bank'),
            'logo_bank' => $fotoNama,
        ]);

        return redirect()->route('sistem.bank')->with('success', 'Berhasil menambahkan bank.');
    }

    // Menampilkan halaman edit bank
    public function edit($id)
    {
        $setting = Setting::first();
        $bank = Bank::find($id);

        return view('sistem.bank.edit', compact('setting', 'bank'));
    }

    // Proses merubah data bank di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required',
            'logo_bank' => 'mimes:png,jpg,jpeg,svg,gif,webp',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        if ($request->logo_bank <> '') {
            $foto = $request->file('logo_bank');
            $namafoto = 'Bank-'.str_replace(' ', '-', $request->get('nama_bank')).'-'.Str::random(4).'.'.$foto->extension();
            $tujuan = 'images';
            $foto->move(public_path($tujuan), $namafoto);
            $fotoNama = $tujuan.'/'.$namafoto;
        }

        $bank = Bank::find($id);
        $bank->nama_bank = $request->get('nama_bank');
        if ($request->logo_bank <> '') {
            File::delete($bank->logo_bank);

            $bank->logo_bank = $fotoNama;
        }
        $bank->save();

        return redirect()->route('sistem.bank')->with('success', 'Berhasil merubah bank.');
    }

    // Proses menghapus bank dari database
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

        File::delete($bank->foto_barang);

        return redirect()->route('sistem.bank')->with('success', 'Berhasil menghapus bank.');
    }
}
