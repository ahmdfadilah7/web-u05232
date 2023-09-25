<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    // Menampilkan halaman contact
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.contact.index', compact('setting'));
    }

    // proses menampilkan data contact dengan datatables
    public function listData()
    {
        $data = Contact::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.contact.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Proses hapus contact
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect()->route('sistem.contact')->with('success', 'Berhasil menghapus contact.');
    }
}
