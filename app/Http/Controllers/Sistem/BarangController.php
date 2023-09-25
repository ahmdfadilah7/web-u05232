<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class BarangController extends Controller
{
    // Menampilkan halaman barang
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.barang.index', compact('setting'));
    }

    // proses menampilkan data barang dengan datatables
    public function listData()
    {
        $data = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->select('barangs.*', 'kategoris.name as nama_kategori');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto_barang', function($row) {
                if ($row->foto_barang <> '') {
                    $img = '<img src="'.url($row->foto_barang).'" width="100">';
                } else {
                    $img = '';
                }
                return $img;
            })
            ->addColumn('harga_barang', function($row) {
                $hrg = 'Rp. '.number_format($row->harga_barang);
                return $hrg;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.barang.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.barang.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'foto_barang', 'harga_barang'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah kategori barang
    public function create()
    {
        $setting = Setting::first();
        $kategori = Kategori::get();

        return view('sistem.barang.add', compact('setting', 'kategori'));
    }

    // Proses menambahkan data barang ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'foto_barang' => 'required|mimes:jpg,jpeg,svg,png,gif,webp',
            'harga_barang' => 'required',
            'stok' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $foto = $request->file('foto_barang');
        $namafoto = 'Barang-'.str_replace(' ', '-', $request->get('nama_barang')).'-'.Str::random(4).'.'.$foto->extension();
        $tujuan = 'images';
        $foto->move(public_path($tujuan), $namafoto);
        $fotoNama = $tujuan.'/'.$namafoto;

        Barang::create([
            'nama_barang' => $request->get('nama_barang'),
            'kategori_id' => $request->get('kategori_id'),
            'foto_barang' => $fotoNama,
            'harga_barang' => $request->get('harga_barang'),
            'stok' => $request->get('stok'),
        ]);

        return redirect()->route('sistem.barang')->with('success', 'Berhasil menambahkan barang.');
    }

    // Menampilkan halaman edit barang
    public function edit($id)
    {
        $setting = Setting::first();
        $barang = Barang::find($id);
        $kategori = Kategori::get();

        return view('sistem.barang.edit', compact('setting', 'barang', 'kategori'));
    }

    // Proses merubah data barang di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'foto_barang' => 'mimes:png,jpg,jpeg,svg,gif,webp',
            'harga_barang' => 'required',
            'stok' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        if ($request->foto_barang <> '') {
            $foto = $request->file('foto_barang');
            $namafoto = 'Barang-'.str_replace(' ', '-', $request->get('nama_barang')).'-'.Str::random(4).'.'.$foto->extension();
            $tujuan = 'images';
            $foto->move(public_path($tujuan), $namafoto);
            $fotoNama = $tujuan.'/'.$namafoto;
        }

        $barang = Barang::find($id);
        $barang->kategori_id = $request->get('kategori_id');
        $barang->nama_barang = $request->get('nama_barang');
        if ($request->foto_barang <> '') {
            File::delete($barang->foto_barang);

            $barang->foto_barang = $fotoNama;
        }
        $barang->harga_barang = $request->get('harga_barang');
        $barang->stok = $request->get('stok');
        $barang->save();

        return redirect()->route('sistem.barang')->with('success', 'Berhasil merubah barang.');
    }

    // Proses menghapus barang dari database
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        File::delete($barang->foto_barang);

        return redirect()->route('sistem.barang')->with('success', 'Berhasil menghapus barang.');
    }
}
