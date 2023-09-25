<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NilaiController extends Controller
{
    // Menampilkan halaman nilai
    public function index() 
    {
        $setting = Setting::first();

        return view('sistem.nilai.index', compact('setting'));
    }

    // proses menampilkan data nilai dengan datatables
    public function listData() 
    {
        $data = Nilai::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.nilai.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.nilai.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $datatables;
    }

    // Menampilkan halaman tambah nilai
    public function create() 
    {
        $setting = Setting::first();

        return view('sistem.nilai.add', compact('setting'));
    }

    // Proses menambahkan nilai ke database
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'intensitas_kepentingan' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Nilai::create([
            'kepentingan' => $request->get('intensitas_kepentingan'),
            'keterangan' => $request->get('keterangan')
        ]);

        return redirect()->route('sistem.nilai')->with('success', 'Berhasil menambahkan nilai.');
    }

    // Menampilkan halaman edit nilai
    public function edit($id) 
    {
        $setting = Setting::first();
        $nilai = Nilai::find($id);

        return view('sistem.nilai.edit', compact('setting', 'nilai'));
    }

    // Proses mengedit nilai ke database
    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'intensitas_kepentingan' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $nilai = Nilai::find($id);
        $nilai->kepentingan = $request->get('intensitas_kepentingan');
        $nilai->keterangan = $request->get('keterangan');
        $nilai->save();

        return redirect()->route('sistem.nilai')->with('success', 'Berhasil mengedit nilai.');
    }

    // Proses menghapus nilai
    public function destroy($id) 
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        return redirect()->route('sistem.nilai')->with('success', 'Berhasil menghapus nilai.');
    }
}
