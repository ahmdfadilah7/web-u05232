<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        $setting = Setting::first();
        $jumlahinvoice = Invoice::count();
        $invoiceselesai = Invoice::where('status', '4');
        $invoicedibatalkan = Invoice::where('status', '5');
        
        return view('sistem.dashboard.index', compact('setting', 'invoiceselesai', 'invoicedibatalkan', 'jumlahinvoice'));
    }
}
