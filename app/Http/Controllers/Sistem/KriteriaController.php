<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\AnalisisKriteria;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    // Menampilkan halaman kriteria
    public function index() 
    {
        $setting = Setting::first();

        return view('sistem.kriteria.index', compact('setting'));
    }

    // proses menampilkan data kategori barang dengan datatables
    public function listData() 
    {
        $data = Kriteria::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.kriteria.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.kriteria.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $datatables;
    }

    // Menampilkan halaman tambah kriteria
    public function create() 
    {
        $setting = Setting::first();
        $count_kriteria = Kriteria::max('kode_kriteria');
        if ($count_kriteria <> '') {
            $urutan = (int) substr($count_kriteria, 3,5);
            $urutan++;
            $kode_kriteria = 'KR'.sprintf('%03s', $urutan);
        } else {
            $kode_kriteria = 'KR001';
        }

        return view('sistem.kriteria.add', compact('setting', 'kode_kriteria'));
    }

    // Proses menambahkan data kriteria ke database
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required',
            'kriteria' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $check_kritera = Kriteria::select('*');

        $kriteria = new Kriteria;
        $kriteria->kode_kriteria = $request->get('kode_kriteria');
        $kriteria->kriteria = $request->get('kriteria');
        $kriteria->save();
        $kriteria_id = $kriteria->id;

        if ($check_kritera->count() > 0) {
            $data = array();

            foreach ($check_kritera->get() as $row) {
                
                if ($row->id < $kriteria_id) {
                    array_push($data, 
                        array(
                            'kode_kriteria_1' => $row->id,
                            'kode_kriteria_2' => $kriteria_id,
                            'nilai' => 1,
                        ),
                        array(
                            'kode_kriteria_1' => $kriteria_id,
                            'kode_kriteria_2' => $row->id,
                            'nilai' => 1,
                        )
                    );
                }
            }
            array_push($data, 
                array(
                    'kode_kriteria_1'=> $kriteria_id,
                    'kode_kriteria_2'=> $kriteria_id,
                    'nilai'=> 1,
                )
            );

            AnalisisKriteria::insert($data);
        } else {
            AnalisisKriteria::create([
                'kode_kriteria_1' => $kriteria_id,
                'kode_kriteria_2' => $kriteria_id,
                'nilai' => 1
            ]);
        }

        return redirect()->route('sistem.kriteria')->with('success', 'Berhasil menambahkan kriteria.');
    }

    // Menampilkan halaman edit kriteria
    public function edit($id) 
    {
        $setting = Setting::first();
        $kriteria = Kriteria::find($id);

        return view('sistem.kriteria.edit', compact('setting', 'kriteria'));
    }

    // Proses mengedit kriteria
    public function update(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required',
            'kriteria' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $kriteria = Kriteria::find($id);
        $kriteria->kriteria = $request->get('kriteria');
        $kriteria->save();

        return redirect()->route('sistem.kriteria')->with('success', 'Berhasil mengedit kriteria.');
    }
    
    // Proses menghapus kriteria dari database
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();

        return redirect()->route('sistem.kriteria')->with('success', 'Berhasil menghapus kriteria.');
    }
}
