<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Sistem\AuthController;
use App\Http\Controllers\Sistem\BankController;
use App\Http\Controllers\Sistem\BarangController;
use App\Http\Controllers\Sistem\ContactController as SistemContactController;
use App\Http\Controllers\Sistem\DashboardController;
use App\Http\Controllers\Sistem\HitungController;
use App\Http\Controllers\Sistem\JasakirimController;
use App\Http\Controllers\Sistem\KategoriController;
use App\Http\Controllers\Sistem\KriteriaController;
use App\Http\Controllers\Sistem\NilaiController;
use App\Http\Controllers\Sistem\PegawaiController;
use App\Http\Controllers\Sistem\RekeningController;
use App\Http\Controllers\Sistem\SettingController;
use App\Http\Controllers\Sistem\SliderController;
use App\Http\Controllers\Sistem\TransaksiController;
use App\Http\Controllers\SpkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [HomeController::class, 'login'])->name('login');
Route::post('proses_login', [HomeController::class, 'proses_login'])->name('prosesLogin');
Route::get('register', [HomeController::class, 'register'])->name('register');
Route::post('proses_register', [HomeController::class, 'proses_register'])->name('prosesRegister');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');

Route::get('contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('contact-us/proses_add', [ContactController::class, 'store'])->name('contact.proses_add');
Route::get('about-us', [AboutController::class, 'index'])->name('about');

Route::get('product', [ProductController::class, 'index'])->name('product');
Route::get('product/category/{slug}', [ProductController::class, 'category'])->name('product.category');
Route::get('product/search', [ProductController::class, 'search'])->name('product.search');

Route::get('get_product/{id}', [HomeController::class, 'get_product'])->name('get_product');

Route::get('spk', [SpkController::class, 'index'])->name('spk');
Route::post('spk/filter', [SpkController::class, 'filter'])->name('spk.filter');

Route::group(['middleware' => ['auth:webpelanggan']], function () {

    // Mengarahkan ke Profil Controller
    Route::get('profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('profil/ubah/{id}', [ProfilController::class, 'ubah_profil'])->name('profil.ubah');
    Route::put('profil/update/{id}', [ProfilController::class, 'proses_ubah_profil'])->name('profil.update');
    Route::get('profil/alamat', [ProfilController::class, 'alamat'])->name('profil.alamat');
    Route::get('profil/alamat/add', [ProfilController::class, 'alamat_add'])->name('profil.alamat.add');
    Route::post('profil/alamat/proses_add', [ProfilController::class, 'alamat_proses_add'])->name('profil.alamat.proses_add');
    Route::get('profil/alamat/edit/{id}', [ProfilController::class, 'alamat_edit'])->name('profil.alamat.edit');
    Route::put('profil/alamat/proses_update/{id}', [ProfilController::class, 'alamat_proses_update'])->name('profil.alamat.proses_update');
    Route::get('profil/alamat/delete/{id}', [ProfilController::class, 'alamat_delete'])->name('profil.alamat.delete');

    // Mengarahkan ke Cart Controller
    Route::get('keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('keranjang/tambah', [CartController::class, 'store'])->name('keranjang.tambah');
    Route::post('keranjang/updatekuantitas/{id}', [CartController::class, 'update_kuantitas'])->name('keranjang.updatekuantitas');
    Route::get('keranjang/hapusbarang/{id}', [CartController::class, 'delete_barang'])->name('keranjang.hapusbarang');

    Route::get('keranjang/checkout/{inv}', [CartController::class, 'checkout'])->name('keranjang.checkout');
    Route::get('alamat/{id}', [CartController::class, 'alamat'])->name('alamat');
    Route::get('keranjang/batalkan/{inv}', [CartController::class, 'batalkan'])->name('keranjang.batalkan');
    Route::post('keranjang/proses_checkout/{inv}', [CartController::class, 'proses_checkout'])->name('keranjang.prosescheckout');
    Route::get('keranjang/invoice_pembayaran/{inv}', [CartController::class, 'invoice_pembayaran'])->name('keranjang.invoice_pembayaran');
    Route::post('keranjang/proses_pembayaran', [CartController::class, 'proses_pembayaran'])->name('keranjang.proses_pembayaran');
});

// Pengarahan Controller untuk Sistem
Route::get('sistem', [AuthController::class, 'login'])->name('sistem.login');
Route::get('sistem/login', [AuthController::class, 'login'])->name('sistem.login');
Route::post('sistem/prosesLogin', [AuthController::class, 'proses_login'])->name('sistem.proseslogin');
Route::get('sistem/logout', [AuthController::class, 'logout'])->name('sistem.logout');

Route::group(['middleware' => ['auth:websistem']], function () {

    // Mengarahkan ke Dashboard Controller
    Route::get('sistem/dashboard', [DashboardController::class, 'index'])->name('sistem.dashboard');

    // Mengarahkan ke Pegawai Controller
    Route::get('sistem/pegawai', [PegawaiController::class, 'index'])->name('sistem.pegawai');
    Route::get('sistem/pegawai/getListData', [PegawaiController::class, 'listData'])->name('sistem.pegawai.list');
    Route::get('sistem/pegawai/add', [PegawaiController::class, 'create'])->name('sistem.pegawai.add');
    Route::post('sistem/pegawai/store', [PegawaiController::class, 'store'])->name('sistem.pegawai.store');
    Route::get('sistem/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('sistem.pegawai.edit');
    Route::put('sistem/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('sistem.pegawai.update');
    Route::get('sistem/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('sistem.pegawai.delete');

    // Mengarahkan ke Kategori Controller
    Route::get('sistem/kategori', [KategoriController::class, 'index'])->name('sistem.kategori');
    Route::get('sistem/kategori/getListData', [KategoriController::class, 'listData'])->name('sistem.kategori.list');
    Route::get('sistem/kategori/add', [KategoriController::class, 'create'])->name('sistem.kategori.add');
    Route::post('sistem/kategori/store', [KategoriController::class, 'store'])->name('sistem.kategori.store');
    Route::get('sistem/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('sistem.kategori.edit');
    Route::put('sistem/kategori/update/{id}', [KategoriController::class, 'update'])->name('sistem.kategori.update');
    Route::get('sistem/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('sistem.kategori.delete');

    // Mengarahkan ke Nilai Controller
    Route::get('sistem/nilai', [NilaiController::class, 'index'])->name('sistem.nilai');
    Route::get('sistem/nilai/getListData', [NilaiController::class, 'listData'])->name('sistem.nilai.list');
    Route::get('sistem/nilai/add', [NilaiController::class, 'create'])->name('sistem.nilai.add');
    Route::post('sistem/nilai/store', [NilaiController::class, 'store'])->name('sistem.nilai.store');
    Route::get('sistem/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('sistem.nilai.edit');
    Route::put('sistem/nilai/update/{id}', [NilaiController::class, 'update'])->name('sistem.nilai.update');
    Route::get('sistem/nilai/delete/{id}', [NilaiController::class, 'destroy'])->name('sistem.nilai.delete');

    // Mengarahkan ke Kriteria Controller
    Route::get('sistem/kriteria', [KriteriaController::class, 'index'])->name('sistem.kriteria');
    Route::get('sistem/kriteria/getListData', [KriteriaController::class, 'listData'])->name('sistem.kriteria.list');
    Route::get('sistem/kriteria/add', [KriteriaController::class, 'create'])->name('sistem.kriteria.add');
    Route::post('sistem/kriteria/store', [KriteriaController::class, 'store'])->name('sistem.kriteria.store');
    Route::get('sistem/kriteria/edit/{id}', [KriteriaController::class, 'edit'])->name('sistem.kriteria.edit');
    Route::put('sistem/kriteria/update/{id}', [KriteriaController::class, 'update'])->name('sistem.kriteria.update');
    Route::get('sistem/kriteria/delete/{id}', [KriteriaController::class, 'destroy'])->name('sistem.kriteria.delete');

    // Mengarahkan ke Hitung Controller
    Route::get('sistem/hitung/kriteria', [HitungController::class, 'kriteria'])->name('sistem.hitung.kriteria');
    Route::post('sistem/hitung/updatenilaikriteria', [HitungController::class, 'update_nilai_kriteria'])->name('sistem.hitung.updatenilaikriteria');
    Route::get('sistem/hitung/savenilaikriteria', [HitungController::class, 'save_nilai_kriteria'])->name('sistem.hitung.savenilaikriteria');
    Route::get('sistem/hitung/alternatif', [HitungController::class, 'alternatif'])->name('sistem.hitung.alternatif');
    Route::get('sistem/hitung/hitungalternatif/{id}', [HitungController::class, 'hitung_alternatif'])->name('sistem.hitung.hitungalternatif');
    Route::post('sistem/hitung/updatenilaialternatif/{id}', [HitungController::class, 'update_nilai_alternatif'])->name('sistem.hitung.updatenilaialternatif');
    Route::get('sistem/hitung/savenilaialternatif/{id}', [HitungController::class, 'save_nilai_alternatif'])->name('sistem.hitung.savenilaialternatif');
    Route::get('sistem/hitung/saverankingalternatif', [HitungController::class, 'save_ranking_alternatif'])->name('sistem.hitung.saverankingalternatif');
    
    // Mengarahkan ke Contact Controller
    Route::get('sistem/contact', [SistemContactController::class, 'index'])->name('sistem.contact');
    Route::get('sistem/contact/getListData', [SistemContactController::class, 'listData'])->name('sistem.contact.list');
    Route::get('sistem/contact/delete/{id}', [SistemContactController::class, 'destroy'])->name('sistem.contact.delete');

    // Mengarahkan ke Transaksi Controller
    Route::get('sistem/transaksi', [TransaksiController::class, 'index'])->name('sistem.transaksi');
    Route::get('sistem/transaksi/getListData', [TransaksiController::class, 'listData'])->name('sistem.transaksi.list');
    Route::get('sistem/transaksi/konfirmasi/{id}', [TransaksiController::class, 'konfirmasi'])->name('sistem.transaksi.konfirmasi');
    Route::get('sistem/transaksi/selesai/{id}', [TransaksiController::class, 'selesai'])->name('sistem.transaksi.selesai');
    Route::get('sistem/transaksi/batalkan/{id}', [TransaksiController::class, 'batalkan'])->name('sistem.transaksi.batalkan');
    Route::get('sistem/transaksi/invoice/{id}', [TransaksiController::class, 'invoice'])->name('sistem.transaksi.invoice');

    // Mengarahkan ke Jasa Kirim Controller
    Route::get('sistem/jasakirim', [JasakirimController::class, 'index'])->name('sistem.jasakirim');
    Route::get('sistem/jasakirim/getListData', [JasakirimController::class, 'listData'])->name('sistem.jasakirim.list');
    Route::get('sistem/jasakirim/add', [JasakirimController::class, 'create'])->name('sistem.jasakirim.add');
    Route::post('sistem/jasakirim/store', [JasakirimController::class, 'store'])->name('sistem.jasakirim.store');
    Route::get('sistem/jasakirim/edit/{id}', [JasakirimController::class, 'edit'])->name('sistem.jasakirim.edit');
    Route::put('sistem/jasakirim/update/{id}', [JasakirimController::class, 'update'])->name('sistem.jasakirim.update');
    Route::get('sistem/jasakirim/delete/{id}', [JasakirimController::class, 'destroy'])->name('sistem.jasakirim.delete');

    // Mengarahkan ke Slider Controller
    Route::get('sistem/slider', [SliderController::class, 'index'])->name('sistem.slider');
    Route::get('sistem/slider/getListData', [SliderController::class, 'listData'])->name('sistem.slider.list');
    Route::get('sistem/slider/add', [SliderController::class, 'create'])->name('sistem.slider.add');
    Route::post('sistem/slider/store', [SliderController::class, 'store'])->name('sistem.slider.store');
    Route::get('sistem/slider/edit/{id}', [SliderController::class, 'edit'])->name('sistem.slider.edit');
    Route::put('sistem/slider/update/{id}', [SliderController::class, 'update'])->name('sistem.slider.update');
    Route::get('sistem/slider/delete/{id}', [SliderController::class, 'destroy'])->name('sistem.slider.delete');

    // Mengarahkan ke Barang Controller
    Route::get('sistem/barang', [BarangController::class, 'index'])->name('sistem.barang');
    Route::get('sistem/barang/getListData', [BarangController::class, 'listData'])->name('sistem.barang.list');
    Route::get('sistem/barang/add', [BarangController::class, 'create'])->name('sistem.barang.add');
    Route::post('sistem/barang/store', [BarangController::class, 'store'])->name('sistem.barang.store');
    Route::get('sistem/barang/edit/{id}', [BarangController::class, 'edit'])->name('sistem.barang.edit');
    Route::put('sistem/barang/update/{id}', [BarangController::class, 'update'])->name('sistem.barang.update');
    Route::get('sistem/barang/delete/{id}', [BarangController::class, 'destroy'])->name('sistem.barang.delete');

    // Mengarahkan ke Bank Controller
    Route::get('sistem/bank', [BankController::class, 'index'])->name('sistem.bank');
    Route::get('sistem/bank/getListData', [BankController::class, 'listData'])->name('sistem.bank.list');
    Route::get('sistem/bank/add', [BankController::class, 'create'])->name('sistem.bank.add');
    Route::post('sistem/bank/store', [BankController::class, 'store'])->name('sistem.bank.store');
    Route::get('sistem/bank/edit/{id}', [BankController::class, 'edit'])->name('sistem.bank.edit');
    Route::put('sistem/bank/update/{id}', [BankController::class, 'update'])->name('sistem.bank.update');
    Route::get('sistem/bank/delete/{id}', [BankController::class, 'destroy'])->name('sistem.bank.delete');

    // Mengarahkan ke Rekening Controller
    Route::get('sistem/rekening', [RekeningController::class, 'index'])->name('sistem.rekening');
    Route::get('sistem/rekening/getListData', [RekeningController::class, 'listData'])->name('sistem.rekening.list');
    Route::get('sistem/rekening/add', [RekeningController::class, 'create'])->name('sistem.rekening.add');
    Route::post('sistem/rekening/store', [RekeningController::class, 'store'])->name('sistem.rekening.store');
    Route::get('sistem/rekening/edit/{id}', [RekeningController::class, 'edit'])->name('sistem.rekening.edit');
    Route::put('sistem/rekening/update/{id}', [RekeningController::class, 'update'])->name('sistem.rekening.update');
    Route::get('sistem/rekening/delete/{id}', [RekeningController::class, 'destroy'])->name('sistem.rekening.delete');

    // Mengarahkan ke Setting Controller
    Route::get('sistem/setting', [SettingController::class, 'index'])->name('sistem.setting');
    Route::get('sistem/setting/getListData', [SettingController::class, 'listData'])->name('sistem.setting.list');
    Route::get('sistem/setting/add', [SettingController::class, 'create'])->name('sistem.setting.add');
    Route::post('sistem/setting/store', [SettingController::class, 'store'])->name('sistem.setting.store');
    Route::get('sistem/setting/edit/{id}', [SettingController::class, 'edit'])->name('sistem.setting.edit');
    Route::put('sistem/setting/update/{id}', [SettingController::class, 'update'])->name('sistem.setting.update');

});