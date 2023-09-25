<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\JasaKirim;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class JasakirimController extends Controller
{
    // Menampilkan halaman jasa kirim
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.jasakirim.index', compact('setting'));
    }

    // proses menampilkan data jasa kirim dengan datatables
    public function listData()
    {
        $data = Jasakirim::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.jasakirim.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.jasakirim.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah jasa kirim
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.jasakirim.add', compact('setting'));
    }

    // Proses menambahkan data jasa kirim ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Jasakirim::create([
            'nama' => $request->get('nama'),
        ]);

        return redirect()->route('sistem.jasakirim')->with('success', 'Berhasil menambahkan jasa kirim.');
    }

    // Menampilkan halaman edit jasa kirim
    public function edit($id)
    {
        $setting = Setting::first();
        $jasakirim = Jasakirim::find($id);

        return view('sistem.jasakirim.edit', compact('setting', 'jasakirim'));
    }

    // Proses merubah data jasa kirim di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        $jasakirim = Jasakirim::find($id);
        $jasakirim->name = $request->get('nama');
        $jasakirim->save();

        return redirect()->route('sistem.jasakirim')->with('success', 'Berhasil merubah jasa kirim.');
    }

    // Proses menghapus Jasa Kirim dari database
    public function destroy($id)
    {
        $jasakirim = JasaKirim::find($id);
        $jasakirim->delete();

        return redirect()->route('sistem.jasakirim')->with('success', 'Berhasil menghapus jasa kirim.');
    }
}
