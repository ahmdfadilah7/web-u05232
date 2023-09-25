<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    // Menampilkan halaman pegawai 
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.pegawai.index', compact('setting'));
    }

    // proses menampilkan data pegawai  dengan datatables
    public function listData()
    {
        if (Auth::guard('websistem')->user()->role=='Administrator') {
            $data = User::query();
        } else {
            $data = User::where('id', Auth::guard('websistem')->user()->id);
        }
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function($row) {
                if ($row->foto <> '') {
                    $img = '<img src="'.url($row->foto).'" width="50">';
                } else {
                    $img = '<img src="'.url('images/user-1.jpg').'" width="50">';
                }

                return $img;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.pegawai.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                if ($row->id <> Auth::guard('websistem')->user()->id) {
                    $btn .= '<a href="'.route('sistem.pegawai.delete', $row->id).'" class="btn btn-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </a>';
                }
                return $btn;
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah pegawai 
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.pegawai.add', compact('setting'));
    }

    // Proses menambahkan data pegawai  ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'foto' => 'mimes:png,jpg,jpeg,webp,svg',
            'role' => 'required',
            'password' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!',
            'unique' => ':attribute sudah ada !!',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Pegawai-'.str_replace(' ', '-', $request->get('name')).Str::random(5).'.'.$foto->extension();
            $foto->move(public_path('images/'), $namafoto);
            $fotoNama = 'images/'.$namafoto;
        } else {
            $fotoNama = '';
        }

        User::create([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'foto' => $fotoNama,
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('sistem.pegawai')->with('success', 'Berhasil menambahkan pegawai.');
    }

    // Menampilkan halaman edit pegawai 
    public function edit($id)
    {
        $setting = Setting::first();
        $pegawai = User::find($id);

        return view('sistem.pegawai.edit', compact('setting', 'pegawai'));
    }

    // Proses merubah data pegawai  di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'foto' => 'mimes:png,jpg,jpeg,webp,svg',
            'role' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!',
            'unique' => ':attribute sudah ada !!',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Pegawai-'.str_replace(' ', '-', $request->get('name')).Str::random(5).'.'.$foto->extension();
            $foto->move(public_path('images/'), $namafoto);
            $fotoNama = 'images/'.$namafoto;
        } else {
            $fotoNama = '';
        }

        $pegawai = User::find($id);
        $pegawai->name = $request->get('name');
        $pegawai->username = $request->get('username');
        $pegawai->email = $request->get('email');
        $pegawai->role = $request->get('role');
        if ($request->foto <> '') {
            $pegawai->foto = $fotoNama;
        }
        if ($request->password <> '') {
            $pegawai->password = Hash::make($request->get('password'));
        }
        $pegawai->save();

        return redirect()->route('sistem.pegawai')->with('success', 'Berhasil merubah pegawai.');
    }

    // Proses menghapus pegawai dari database
    public function destroy($id)
    {
        $pegawai = User::find($id);
        $pegawai->delete();

        return redirect()->route('sistem.pegawai')->with('success', 'Berhasil menghapus pegawai.');
    }
}
