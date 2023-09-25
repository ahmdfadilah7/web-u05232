<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    // Menampilkan halaman slider
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.slider.index', compact('setting'));
    }

    // proses menampilkan data slider dengan datatables
    public function listData()
    {
        $data = Slider::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('gambar', function($row) {
                $gambar = '<img src="'.url($row->gambar).'" width="70">';
                return $gambar;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.slider.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.slider.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'gambar'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah slider
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.slider.add', compact('setting'));
    }

    // Proses menambahkan data slider ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|mimes:png,jpg,jpeg,webp,svg',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->gambar <> '') {
            $gambar = $request->file('gambar');
            $namagambar = 'Slider-'.Str::random(5).'.'.$gambar->extension();
            $gambar->move(public_path('images'), $namagambar);
            $gambarName = 'images/'.$namagambar;
        }

        Slider::create([
            'gambar' => $gambarName,
        ]);

        return redirect()->route('sistem.slider')->with('success', 'Berhasil menambahkan slider.');
    }

    // Menampilkan halaman edit slider
    public function edit($id)
    {
        $setting = Setting::first();
        $slider = Slider::find($id);

        return view('sistem.slider.edit', compact('setting', 'slider'));
    }

    // Proses merubah data slider di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|mimes:png,jpg,jpeg,svg,webp',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        if ($request->gambar <> '') {
            $gambar = $request->file('gambar');
            $namagambar = 'Slider-'.Str::random(5).'.'.$gambar->extension();
            $gambar->move(public_path('images'), $namagambar);
            $gambarName = 'images/'.$namagambar;
        }

        $slider = Slider::find($id);
        if ($request->gambar <> '') {
            File::delete($slider->gambar);

            $slider->gambar = $gambarName;
        }
        $slider->save();

        return redirect()->route('sistem.slider')->with('success', 'Berhasil merubah slider.');
    }

    // Proses menghapus slider dari database
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        File::delete($slider->gambar);

        return redirect()->route('sistem.slider')->with('success', 'Berhasil menghapus slider.');
    }
}
