<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Rekening;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class RekeningController extends Controller
{
    // Menampilkan halaman rekening
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.rekening.index', compact('setting'));
    }

    // proses menampilkan data rekening dengan datatables
    public function listData()
    {
        $data = Rekening::join('banks', 'rekenings.bank_id', 'banks.id')
                ->select('rekenings.*', 'banks.logo_bank');
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
                $btn = '<a href="'.route('sistem.rekening.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.rekening.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo_bank'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah rekening
    public function create()
    {
        $setting = Setting::first();
        $bank = Bank::get();

        return view('sistem.rekening.add', compact('setting', 'bank'));
    }

    // Proses menambahkan data rekening ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_id' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Rekening::create([
            'bank_id' => $request->get('bank_id'),
            'nama_rekening' => $request->get('nama_rekening'),
            'no_rekening' => $request->get('no_rekening'),
        ]);

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil menambahkan rekening.');
    }

    // Menampilkan halaman edit rekening
    public function edit($id)
    {
        $setting = Setting::first();
        $bank = Bank::get();
        $rekening = Rekening::find($id);

        return view('sistem.rekening.edit', compact('setting', 'rekening', 'bank'));
    }

    // Proses merubah data rekening di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bank_id' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        $rekening = Rekening::find($id);
        $rekening->bank_id = $request->get('bank_id');
        $rekening->nama_rekening = $request->get('nama_rekening');
        $rekening->no_rekening = $request->get('no_rekening');
        $rekening->save();

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil merubah rekening.');
    }

    // Proses menghapus rekening dari database
    public function destroy($id)
    {
        $rekening = Rekening::find($id);
        $rekening->delete();

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil menghapus rekening.');
    }
}
