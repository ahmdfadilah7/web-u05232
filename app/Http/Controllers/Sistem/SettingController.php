<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    // Menampilkan halaman setting website
    public function index()
    {
        $setting = Setting::first();
        $count = Setting::count();

        return view('sistem.setting.index', compact('setting', 'count'));
    }

    // proses menampilkan data setting website dengan datatables
    public function listData()
    {
        $data = Setting::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                $logo = '<img src="'.url($row->logo).'" width="70">';
                return $logo;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.setting.edit', $row->id).'" class="btn btn-primary btn-sm mr-2">
                            <i class="ti ti-edit"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah setting website
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.setting.add', compact('setting'));
    }

    // Proses menambahkan data setting website ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_website' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'google_map' => 'required',
            'no_telp' => 'required',
            'about_us' => 'required',
            'logo' => 'required|mimes:jpg,jpeg,png,svg,gif',
            'favicon' => 'required|mimes:jpg,jpeg,png,svg,gif',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $logo = $request->file('logo');
        $namalogo = 'Logo-'.str_replace(' ', '-', $request->get('nama_website')).'-'.Str::random(4).'.'.$logo->extension();
        $tujuan = 'images';
        $logo->move(public_path($tujuan), $namalogo);
        $logoNama = $tujuan.'/'.$namalogo;

        $favicon = $request->file('favicon');
        $namafavicon = 'Favicon-'.str_replace(' ', '-', $request->get('nama_website')).'-'.Str::random(4).'.'.$favicon->extension();
        $favicon->move(public_path($tujuan), $namafavicon);
        $faviconNama = $tujuan.'/'.$namafavicon;

        Setting::create([
            'nama_website' => $request->get('nama_website'),
            'logo' => $logoNama,
            'favicon' => $faviconNama,
            'alamat' => $request->get('alamat'),
            'google_map' => $request->get('google_map'),
            'email' => $request->get('email'),
            'no_telp' => $request->get('no_telp'),
            'about_us' => $request->get('about_us')
        ]);

        return redirect()->route('sistem.setting')->with('success', 'Berhasil menambahkan setting website.');
    }

    // Menampilkan halaman edit setting website
    public function edit($id)
    {
        $setting = Setting::find($id);

        return view('sistem.setting.edit', compact('setting'));
    }

    // Proses merubah data setting website di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_website' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'google_map' => 'required',
            'no_telp' => 'required',
            'about_us' => 'required',
            'logo' => 'mimes:jpg,jpeg,png,svg,gif',
            'favicon' => 'mimes:jpg,jpeg,png,svg,gif',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namalogo = 'Logo-'.str_replace(' ', '-', $request->get('nama_website')).'-'.Str::random(4).'.'.$logo->extension();
            $tujuan = 'images';
            $logo->move(public_path($tujuan), $namalogo);
            $logoNama = $tujuan.'/'.$namalogo;
        }

        if ($request->favicon <> '') {
            $favicon = $request->file('favicon');
            $namafavicon = 'Favicon-'.str_replace(' ', '-', $request->get('nama_website')).'-'.Str::random(4).'.'.$favicon->extension();
            $favicon->move(public_path($tujuan), $namafavicon);
            $faviconNama = $tujuan.'/'.$namafavicon;
        }

        $setting = Setting::find($id);
        $setting->nama_website = $request->get('nama_website');
        if ($request->logo <> '') {
            $setting->logo = $logoNama;
        }
        if ($request->favicon <> '') {
            $setting->favicon = $faviconNama;
        }
        $setting->alamat = $request->get('alamat');
        $setting->google_map = $request->get('google_map');
        $setting->email = $request->get('email');
        $setting->no_telp = $request->get('no_telp');
        $setting->about_us = $request->get('about_us');
        $setting->save();

        return redirect()->route('sistem.setting')->with('success', 'Berhasil merubah setting website.');
    }

}
