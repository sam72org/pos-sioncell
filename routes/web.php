<?php
use App\TaPenjualan;
use App\TaPembelian;
use App\RefBarang;
use App\RefPelanggan;
use App\User;

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
        $jlh_penjualan  = TaPenjualan::count();
        $jlh_pembelian  = TaPembelian::count();
        $jlh_barang     = RefBarang::count();
        $jlh_user       = User::count();

        return view('dashboard', [
            'model' => $model, 
            'jlh_penjualan' => $jlh_penjualan,
            'jlh_barang' => $jlh_barang,
            'jlh_pembelian' => $jlh_pembelian,
            'jlh_user' => $jlh_user,
        ]);   
    });

    Route::get('/ref-barang/index', 'RefBarangController@index');
    Route::get('/ref-barang/get-menu', 'RefBarangController@getmenu');
    Route::get('/ref-barang/tambah', 'RefBarangController@tambah');
    Route::get('/ref-barang/create/', 'RefBarangController@create');
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
    Route::get('/ta-penjualan/increase-qty-list', 'TaPenjualanController@tambahQtyList');
    Route::get('/ta-penjualan/decrease-qty-list', 'TaPenjualanController@kurangQtyList');
    Route::get('/ta-penjualan/change-price-list', 'TaPenjualanController@changePriceList');
    Route::get('/ta-penjualan/save-transaction', 'TaPenjualanController@SaveTransaction');
    Route::get('/ta-penjualan/view-transaction/{no_penjualan}', 'TaPenjualanController@ViewTransaction');
    Route::get('/ta-penjualan/print-transaction/{no_penjualan}', 'TaPenjualanController@PrintTransaction');
    Route::get('/ta-penjualan/konfirmasi-pembayaran/{id}', 'TaPenjualanController@KonfirmasiPembayaran');
    Route::get('/ta-penjualan/get-barang', 'TaPenjualanController@GetBarang');
    Route::get('/ta-penjualan/list-item-sold', 'TaPenjualanController@listItemSold');

    Route::get('/ta-pulsa/index', 'TaPulsaController@index');
    Route::get('/ta-pulsa/tambah', 'TaPulsaController@tambah');
    Route::post('/ta-pulsa/create', 'TaPulsaController@create');
    Route::get('/ta-pulsa/ubah/{id}', 'TaPulsaController@ubah');
    Route::post('/ta-pulsa/update/{id}', 'TaPulsaController@update');
    Route::get('/ta-pulsa/hapus/{id}', 'TaPulsaController@hapus');

    Route::get('/ta-jasa/index', 'TaJasaController@index');
    Route::get('/ta-jasa/tambah', 'TaJasaController@tambah');
    Route::post('/ta-jasa/create', 'TaJasaController@create');
    Route::get('/ta-jasa/ubah/{id}', 'TaJasaController@ubah');
    Route::post('/ta-jasa/update/{id}', 'TaJasaController@update');
    Route::get('/ta-jasa/hapus/{id}', 'TaJasaController@hapus');

    Route::get('/ta-pembelian/index', 'TaPembelianController@index');
    Route::get('/ta-pembelian/new-transaction', 'TaPembelianController@NewTransaction');
    Route::post('/ta-pembelian/add-list', 'TaPembelianController@addList');
    Route::get('/ta-pembelian/delete-list', 'TaPembelianController@deleteList');
    Route::get('/ta-pembelian/save-transaction', 'TaPembelianController@SaveTransaction');
    Route::get('/ta-pembelian/view-transaction/{id}', 'TaPembelianController@ViewTransaction');

    Route::get('/laporan/history-stok', 'LaporanController@HistoryStok');   
    Route::get('/laporan/penjualan', 'LaporanController@LaporanPenjualan');   
    Route::get('/laporan/get-penjualan', 'LaporanController@GetPenjualan');   
    Route::get('/laporan/print-penjualan/{tgl_awal}/{tgl_akhir}/{user}', 'LaporanController@PrintPenjualan');

    Route::get('/laporan/pembelian', 'LaporanController@LaporanPembelian');
    Route::get('/laporan/get-pembelian', 'LaporanController@GetPembelian'); 
    Route::get('/laporan/print-pembelian/{tgl_awal}/{tgl_akhir}', 'LaporanController@PrintPembelian');

    Route::get('/laporan/penjualan-pulsa', 'LaporanController@LaporanPenjualanPulsa');
    Route::get('/laporan/get-penjualan-pulsa', 'LaporanController@GetPenjualanPulsa');
    Route::get('/laporan/print-penjualan-pulsa/{tgl_awal}/{tgl_akhir}', 'LaporanController@PrintPenjualanPulsa');

    Route::get('/laporan/penjualan-jasa', 'LaporanController@LaporanPenjualanJasa');
    Route::get('/laporan/get-penjualan-jasa', 'LaporanController@GetPenjualanJasa');
    Route::get('/laporan/print-penjualan-jasa/{tgl_awal}/{tgl_akhir}', 'LaporanController@PrintPenjualanJasa');

    Route::get('/user/index', 'UserController@index');
    Route::get('/user/tambah', 'UserController@tambah');
    Route::post('/user/create', 'UserController@create');
    Route::get('/user/ubah/{id}', 'UserController@ubah');
    Route::post('/user/update/{id}', 'UserController@update');
    Route::get('/user/ubah-password/{id}', 'UserController@ubahpassword');
    Route::post('/user/change-password/{id}', 'UserController@changepassword');

});