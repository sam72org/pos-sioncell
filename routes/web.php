<?php
use App\TaPenjualan;
use App\TaPembelian;
use App\RefBarang;
use App\RefPelanggan;

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

Auth::routes();

Route::middleware(['role', 'auth'])->group(function () { 
    Route::get('/', function () {
        $model = TaPenjualan::orderBy('id', 'DESC')->limit(10)->get();
        $jlh_penjualan = TaPenjualan::count();
        $jlh_pembelian = TaPembelian::count();
        $jlh_barang = RefBarang::count();
        $jlh_pelanggan = RefPelanggan::count();

        return view('dashboard', [
            'model' => $model, 
            'jlh_penjualan' => $jlh_penjualan,
            'jlh_barang' => $jlh_barang,
            'jlh_pembelian' => $jlh_pembelian,
            'jlh_pelanggan' => $jlh_pelanggan,
        ]);   
    });

    Route::get('/ref-barang/index', 'RefBarangController@index');
    Route::get('/ref-barang/get-menu', 'RefBarangController@getmenu');
    Route::get('/ref-barang/tambah', 'RefBarangController@tambah');
    Route::post('/ref-barang/create/', 'RefBarangController@create');
    Route::get('/ref-barang/ubah/{id}', 'RefBarangController@ubah');
    Route::post('/ref-barang/update/{id}', 'RefBarangController@update');
    Route::get('/ref-barang/hapus/{id}', 'RefBarangController@hapus');

    Route::get('/ref-kategori/index', 'RefKategoriController@index');
    Route::get('/ref-kategori/get-kategori', 'RefKategoriController@getkategori');
    Route::get('/ref-kategori/tambah', 'RefKategoriController@tambah');
    Route::post('/ref-kategori/create', 'RefKategoriController@create');
    Route::get('/ref-kategori/ubah/{id}', 'RefKategoriController@ubah');
    Route::post('/ref-kategori/update/{id}', 'RefKategoriController@update');
    Route::get('/ref-kategori/hapus/{id}', 'RefKategoriController@hapus');

    Route::get('/ref-distributor/index', 'RefDistributorController@index');
    Route::get('/ref-distributor/get-kategori', 'RefDistributorController@getkategori');
    Route::get('/ref-distributor/tambah', 'RefDistributorController@tambah');
    Route::post('/ref-distributor/create', 'RefDistributorController@create');
    Route::get('/ref-distributor/ubah/{id}', 'RefDistributorController@ubah');
    Route::post('/ref-distributor/update/{id}', 'RefDistributorController@update');
    Route::get('/ref-distributor/hapus/{id}', 'RefDistributorController@hapus');

    Route::get('/ref-pelanggan/index', 'RefPelangganController@index');
    Route::get('/ref-pelanggan/tambah', 'RefPelangganController@tambah');
    Route::post('/ref-pelanggan/create', 'RefPelangganController@create');
    Route::get('/ref-pelanggan/ubah/{id}', 'RefPelangganController@ubah');
    Route::post('/ref-pelanggan/update/{id}', 'RefPelangganController@update');
    Route::get('/ref-pelanggan/hapus/{id}', 'RefPelangganController@hapus');

    Route::get('/ta-penjualan/index', 'TaPenjualanController@index');
    Route::get('/ta-penjualan/new-transaction', 'TaPenjualanController@NewTransaction');
    Route::post('/ta-penjualan/add-list', 'TaPenjualanController@addList');
    Route::get('/ta-penjualan/delete-list', 'TaPenjualanController@deleteList');
    Route::get('/ta-penjualan/save-transaction', 'TaPenjualanController@SaveTransaction');
    Route::get('/ta-penjualan/view-transaction/{no_penjualan}', 'TaPenjualanController@ViewTransaction');
    Route::get('/ta-penjualan/print-transaction/{no_penjualan}', 'TaPenjualanController@PrintTransaction');
    Route::get('/ta-penjualan/konfirmasi-pembayaran/{id}', 'TaPenjualanController@KonfirmasiPembayaran');

    Route::get('/ta-pembelian/index', 'TaPembelianController@index');
    Route::get('/ta-pembelian/new-transaction', 'TaPembelianController@NewTransaction');
    Route::post('/ta-pembelian/add-list', 'TaPembelianController@addList');
    Route::get('/ta-pembelian/delete-list', 'TaPembelianController@deleteList');
    Route::get('/ta-pembelian/save-transaction', 'TaPembelianController@SaveTransaction');
    Route::get('/ta-pembelian/view-transaction/{id}', 'TaPembelianController@ViewTransaction');

    Route::get('/laporan/history-stok', 'LaporanController@HistoryStok');   
    Route::get('/laporan/penjualan', 'LaporanController@LaporanPenjualan');   
    Route::get('/laporan/get-penjualan', 'LaporanController@GetPenjualan');   
    Route::get('/laporan/print-penjualan/{tgl_awal}/{tgl_akhir}', 'LaporanController@PrintPenjualan');   
    Route::get('/laporan/pembelian', 'LaporanController@LaporanPembelian');
    Route::get('/laporan/get-pembelian', 'LaporanController@GetPembelian'); 
    Route::get('/laporan/print-pembelian/{tgl_awal}/{tgl_akhir}', 'LaporanController@PrintPembelian');
});

  
    