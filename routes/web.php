<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home2Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MataUangController;
use App\Http\Controllers\StatusPemasokController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\ProyekUmumController;
use App\Http\Controllers\PenyesuaianBarangController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/profile', 'profile')->name('profile');
});

Route::controller(Home2Controller::class)->group(function () {
    Route::get('/home_2', 'home_2')->name('/home_2');
    // Route::get('/profile', 'profile')->name('profile');
});

// -----------------------------login----------------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// ------------------------------ register ---------------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register');
});

// ----------------------------- forget password ----------------------------//
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forget-password', 'getEmail')->name('forget-password');
    Route::post('forget-password', 'postEmail')->name('forget-password');
});

// ----------------------------- reset password -----------------------------//
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}', 'getPassword');
    Route::post('reset-password', 'updatePassword');
});

// ----------------------------- booking -----------------------------//
Route::controller(BookingController::class)->group(function () {
    Route::get('form/allbooking', 'allbooking')->name('form/allbooking')->middleware('auth');
    Route::get('form/booking/edit/{bkg_id}', 'bookingEdit')->middleware('auth');
    Route::get('form/booking/add', 'bookingAdd')->middleware('auth')->name('form/booking/add');
    Route::post('form/booking/save', 'saveRecord')->middleware('auth')->name('form/booking/save');
    Route::post('form/booking/update', 'updateRecord')->middleware('auth')->name('form/booking/update');
    Route::post('form/booking/delete', 'deleteRecord')->middleware('auth')->name('form/booking/delete');
    Route::post('form/booking/bulk-delete', 'BookingController@bulkDelete')->name('booking.bulk_delete');
});

// ---------------------------- customers --------------------------//
Route::controller(CustomerController::class)->group(function () {
    Route::get('form/allcustomers/page', 'allCustomers')->middleware('auth')->name('form/allcustomers/page');
    Route::get('form/addcustomer/page', 'addCustomer')->middleware('auth')->name('form/addcustomer/page');
    Route::post('form/addcustomer/save', 'saveCustomer')->middleware('auth')->name('form/addcustomer/save');
    Route::get('form/customer/edit/{bkg_customer_id}', 'updateCustomer')->middleware('auth');
    Route::post('form/customer/update', 'updateRecord')->middleware('auth')->name('form/customer/update');
    Route::post('form/customer/delete', 'deleteRecord')->middleware('auth')->name('form/customer/delete');
});

// ----------------------------- rooms -----------------------------//
Route::controller(RoomsController::class)->group(function () {
    Route::get('form/allrooms/page', 'allrooms')->middleware('auth')->name('form/allrooms/page');
    Route::get('form/addroom/page', 'addRoom')->middleware('auth')->name('form/addroom/page');
    Route::get('form/room/edit/{bkg_room_id}', 'editRoom')->middleware('auth');
    Route::post('form/room/save', 'saveRecordRoom')->middleware('auth')->name('form/room/save');
    Route::post('form/room/delete', 'deleteRecord')->middleware('auth')->name('form/room/delete');
    Route::post('form/room/update', 'updateRecord')->middleware('auth')->name('form/room/update');
});

// ----------------------- user management -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('users/list/page', 'userList')->middleware('auth')->name('users/list/page');
    Route::get('users/add/new', 'userAddNew')->middleware('auth')->name('users/add/new'); /** add new users */
    Route::get('users/add/edit/{user_id}', 'userView'); /** add new users */
    Route::post('users/update', 'userUpdate')->name('users/update'); /** update record */
    Route::get('users/edit/{id}', [UserManagementController::class, 'edit'])->name('usermanagement.edit');
    Route::post('users/update', [UserManagementController::class, 'update'])->name('usermanagement.update');
    Route::get('users/delete/{id}', 'userDelete')->name('users/delete'); /** delere record */
    Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */
});

// ----------------------------- employee -----------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('form/emplyee/list', 'employeesList')->middleware('auth')->name('form/emplyee/list');
    Route::get('form/employee/add', 'employeesAdd')->middleware('auth')->name('form/employee/add');
    Route::get('form/leaves/page', 'leavesPage')->middleware('auth')->name('form/leaves/page');
});

// ----------------------------- matauang -----------------------------//
Route::controller(MataUangController::class)->group(function () {
    Route::get('matauang/list/page', 'matauangList')->middleware('auth')->name('matauang/list/page');
    Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('matauang/add/new', 'MataUangAddNew')->middleware('auth')->name('matauang/add/new');
    Route::post('form/matauang/save', 'saveRecordMataUang')->middleware('auth')->name('form/matauang/save');
    Route::get('/matauang/edit/{id}', [MataUangController::class, 'edit'])->name('matauang.edit');
    Route::post('/matauang/update/{id}', [MataUangController::class, 'update'])->name('matauang.update');
    Route::post('/matauang/delete', [MataUangController::class, 'delete'])->name('matauang.delete');
    Route::get('get-matauang-data', [MataUangController::class, 'getMataUang'])->name('get-matauang-data');
});

Route::controller(StatusPemasokController::class)->group(function () {
    Route::get('statuspemasok/list/page', 'statusPemasokList')->middleware('auth')->name('statuspemasok/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('statuspemasok/add/new', 'StatusPemasokAddNew')->middleware('auth')->name('statuspemasok/add/new');
    Route::post('form/statuspemasok/save', 'saveRecordStatusPemasok')->middleware('auth')->name('form/statuspemasok/save');
    Route::get('/statuspemasok/edit/{id}', [StatusPemasokController::class, 'edit'])->name('statuspemasok/edit');
    Route::post('/statuspemasok/update/{id}', [StatusPemasokController::class, 'update'])->name('statuspemasok/update');
    Route::post('/statuspemasok/delete', [StatusPemasokController::class, 'delete'])->name('statuspemasok/delete');
    Route::get('get-statuspemasok-data', [StatusPemasokController::class, 'getStatusPemasok'])->name('get-statuspemasok-data');
});

Route::controller(PemasokController::class)->group(function () {
    Route::get('pemasok/list/page', 'PemasokList')->middleware('auth')->name('pemasok/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pemasok/add/new', 'PemasokAddNew')->middleware('auth')->name('pemasok/add/new');
    Route::post('form/pemasok/save', 'saveRecordPemasok')->middleware('auth')->name('form/pemasok/save');
    Route::get('/pemasok/edit/{id}/{pemasok_id}', [PemasokController::class, 'edit'])->name('pemasok/edit');
    Route::post('/pemasok/update/{pemasok_id}', [PemasokController::class, 'update'])->name('pemasok/update');
    Route::post('/pemasok/delete', [PemasokController::class, 'delete'])->name('pemasok/delete');
    Route::get('get-pemasok-data', [PemasokController::class, 'getPemasok'])->name('get-pemasok-data');
    Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});

Route::controller(SyaratController::class)->group(function () {
    Route::get('syarat/list/page', 'syaratList')->middleware('auth')->name('syarat/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('syarat/add/new', 'SyaratAddNew')->middleware('auth')->name('syarat/add/new');
    Route::post('form/syarat/save', 'saveRecordSyarat')->middleware('auth')->name('form/syarat/save');
    Route::get('/syarat/edit/{id}', [SyaratController::class, 'edit'])->name('syarat/edit');
    Route::post('/syarat/update/{id}', [SyaratController::class, 'update'])->name('syarat/update');
    Route::post('/syarat/delete', [SyaratController::class, 'delete'])->name('syarat/delete');
    Route::get('get-syarat-data', [SyaratController::class, 'getSyarat'])->name('get-syarat-data');
});

Route::controller(PajakController::class)->group(function () {
    Route::get('pajak/list/page', 'pajakList')->middleware('auth')->name('pajak/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pajak/add/new', 'PajakAddNew')->middleware('auth')->name('pajak/add/new');
    Route::post('form/pajak/save', 'saveRecordPajak')->middleware('auth')->name('form/pajak/save');
    Route::get('/pajak/edit/{id}', [PajakController::class, 'edit'])->name('pajak/edit');
    Route::post('/pajak/update/{id}', [PajakController::class, 'update'])->name('pajak/update');
    Route::post('/pajak/delete', [PajakController::class, 'delete'])->name('pajak/delete');
    Route::get('get-pajak-data', [PajakController::class, 'getPajak'])->name('get-pajak-data');
});

Route::controller(TipePelangganController::class)->group(function () {
    Route::get('tipepelanggan/list/page', 'tipePelangganList')->middleware('auth')->name('tipepelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('tipepelanggan/add/new', 'TipePelangganAddNew')->middleware('auth')->name('tipepelanggan/add/new');
    Route::post('form/tipepelanggan/save', 'saveRecordTipePelanggan')->middleware('auth')->name('form/tipepelanggan/save');
    Route::get('/tipepelanggan/edit/{id}', [TipePelangganController::class, 'edit'])->name('tipepelanggan/edit');
    Route::post('/tipepelanggan/update/{id}', [TipePelangganController::class, 'update'])->name('tipepelanggan/update');
    Route::post('/tipepelanggan/delete', [TipePelangganController::class, 'delete'])->name('tipepelanggan/delete');
    Route::get('get-tipepelanggan-data', [TipePelangganController::class, 'getTipePelanggan'])->name('get-tipepelanggan-data');
});

Route::controller(PelangganController::class)->group(function () {
    Route::get('pelanggan/list/page', 'PelangganList')->middleware('auth')->name('pelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pelanggan/add/new', 'PelangganAddNew')->middleware('auth')->name('pelanggan/add/new');
    Route::post('form/pelanggan/save', 'saveRecordPelanggan')->middleware('auth')->name('form/pelanggan/save');
    Route::get('/pelanggan/edit/{id}/{pelanggan_id}', [PelangganController::class, 'edit'])->name('pelanggan/edit');
    Route::post('/pelanggan/update/{pelanggan_id}', [PelangganController::class, 'update'])->name('pelanggan/update');
    Route::post('/pelanggan/delete', [PelangganController::class, 'delete'])->name('pelanggan/delete');
    Route::get('get-pelanggan-data', [PelangganController::class, 'getPelanggan'])->name('get-pelanggan-data');
    Route::get('/pelanggan/cari', [PelangganController::class, 'cari'])->name('/pelanggan/cari');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});

Route::controller(TipePelangganController::class)->group(function () {
    Route::get('tipepelanggan/list/page', 'tipePelangganList')->middleware('auth')->name('tipepelanggan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('tipepelanggan/add/new', 'TipePelangganAddNew')->middleware('auth')->name('tipepelanggan/add/new');
    Route::post('form/tipepelanggan/save', 'saveRecordTipePelanggan')->middleware('auth')->name('form/tipepelanggan/save');
    Route::get('/tipepelanggan/edit/{id}', [TipePelangganController::class, 'edit'])->name('tipepelanggan/edit');
    Route::post('/tipepelanggan/update/{id}', [TipePelangganController::class, 'update'])->name('tipepelanggan/update');
    Route::post('/tipepelanggan/delete', [TipePelangganController::class, 'delete'])->name('tipepelanggan/delete');
    Route::get('get-tipepelanggan-data', [TipePelangganController::class, 'getTipePelanggan'])->name('get-tipepelanggan-data');
});

Route::controller(PenjualController::class)->group(function () {
    Route::get('penjual/list/page', 'penjualList')->middleware('auth')->name('penjual/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('penjual/add/new', 'PenjualAddNew')->middleware('auth')->name('penjual/add/new');
    Route::post('form/penjual/save', 'saveRecordPenjual')->middleware('auth')->name('form/penjual/save');
    Route::get('/penjual/edit/{id}', [PenjualController::class, 'edit'])->name('penjual/edit');
    Route::post('/penjual/update/{id}', [PenjualController::class, 'update'])->name('penjual/update');
    Route::post('/penjual/delete', [PenjualController::class, 'delete'])->name('penjual/delete');
    Route::get('get-penjual-data', [PenjualController::class, 'getPenjual'])->name('get-penjual-data');
});

Route::controller(DepartemenController::class)->group(function () {
    Route::get('departemen/list/page', 'DepartemenList')->middleware('auth')->name('departemen/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('departemen/add/new', 'DepartemenAddNew')->middleware('auth')->name('departemen/add/new');
    Route::post('form/departemen/save', 'saveRecordDepartemen')->middleware('auth')->name('form/departemen/save');
    Route::get('/departemen/edit/{id}/{departemen_id}', [DepartemenController::class, 'edit'])->name('departemen/edit');
    Route::post('/departemen/update/{departemen_id}', [DepartemenController::class, 'update'])->name('departemen/update');
    Route::post('/departemen/delete', [DepartemenController::class, 'delete'])->name('departemen/delete');
    Route::get('get-departemen-data', [DepartemenController::class, 'getDepartemen'])->name('get-departemen-data');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});

Route::controller(ProyekController::class)->group(function () {
    Route::get('proyek/list/page', 'ProyekList')->middleware('auth')->name('proyek/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('proyek/add/new', 'ProyekAddNew')->middleware('auth')->name('proyek/add/new');
    Route::post('form/proyek/save', 'saveRecordProyek')->middleware('auth')->name('form/proyek/save');
    Route::get('/proyek/edit/{id}/{proyek_id}', [ProyekController::class, 'edit'])->name('proyek/edit');
    Route::post('/proyek/update/{proyek_id}', [ProyekController::class, 'update'])->name('proyek/update');
    Route::post('/proyek/delete', [ProyekController::class, 'delete'])->name('proyek/delete');
    Route::get('get-proyek-data', [ProyekController::class, 'getProyek'])->name('get-proyek-data');
    // Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
    // Route::get('cities', 'DependentDropdownController@cities')->name('cities');
});

Route::controller(PegawaiController::class)->group(function () {
    Route::get('pegawai/list/page', 'pegawaiList')->middleware('auth')->name('pegawai/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('pegawai/add/new', 'PegawaiAddNew')->middleware('auth')->name('pegawai/add/new');
    Route::post('form/pegawai/save', 'saveRecordPegawai')->middleware('auth')->name('form/pegawai/save');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai/edit');
    Route::post('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai/update');
    Route::post('/pegawai/delete', [PegawaiController::class, 'delete'])->name('pegawai/delete');
    Route::get('get-pegawai-data', [PegawaiController::class, 'getPegawai'])->name('get-pegawai-data');
});

Route::controller(SatuanController::class)->group(function () {
    Route::get('satuan/list/page', 'satuanList')->middleware('auth')->name('satuan/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('satuan/add/new', 'SatuanAddNew')->middleware('auth')->name('satuan/add/new');
    Route::post('form/satuan/save', 'saveRecordSatuan')->middleware('auth')->name('form/satuan/save');
    Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit'])->name('satuan/edit');
    Route::post('/satuan/update/{id}', [SatuanController::class, 'update'])->name('satuan/update');
    Route::post('/satuan/delete', [SatuanController::class, 'delete'])->name('satuan/delete');
    Route::get('get-satuan-data', [SatuanController::class, 'getSatuan'])->name('get-satuan-data');
});

Route::controller(GudangController::class)->group(function () {
    Route::get('gudang/list/page', 'gudangList')->middleware('auth')->name('gudang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('gudang/add/new', 'GudangAddNew')->middleware('auth')->name('gudang/add/new');
    Route::post('form/gudang/save', 'saveRecordGudang')->middleware('auth')->name('form/gudang/save');
    Route::get('/gudang/edit/{id}', [GudangController::class, 'edit'])->name('gudang/edit');
    Route::post('/gudang/update/{id}', [GudangController::class, 'update'])->name('gudang/update');
    Route::post('/gudang/delete', [GudangController::class, 'delete'])->name('gudang/delete');
    Route::get('get-gudang-data', [GudangController::class, 'getGudang'])->name('get-gudang-data');
});

Route::controller(KategoriBarangController::class)->group(function () {
    Route::get('kategoribarang/list/page', 'kategoriBarangList')->middleware('auth')->name('kategoribarang/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('kategoribarang/add/new', 'KategoriBarangAddNew')->middleware('auth')->name('kategoribarang/add/new');
    Route::post('form/kategoribarang/save', 'saveRecordKategoriBarang')->middleware('auth')->name('form/kategoribarang/save');
    Route::get('/kategoribarang/edit/{id}', [KategoriBarangController::class, 'edit'])->name('kategoribarang/edit');
    Route::post('/kategoribarang/update/{id}', [KategoriBarangController::class, 'update'])->name('kategoribarang/update');
    Route::post('/kategoribarang/delete', [KategoriBarangController::class, 'delete'])->name('kategoribarang/delete');
    Route::get('get-kategoribarang-data', [KategoriBarangController::class, 'getKategoriBarang'])->name('get-kategoribarang-data');
});

Route::controller(AkunController::class)->group(function () {
    Route::get('akun/list/page', 'akunList')->middleware('auth')->name('akun/list/page');
    // Route::get('matauang/list/page', 'index')->middleware('auth')->name('matauang/list/page');
    Route::get('akun/add/new', 'AkunAddNew')->middleware('auth')->name('akun/add/new');
    Route::post('form/akun/save', 'saveRecordAkun')->middleware('auth')->name('form/akun/save');
    Route::get('/akun/edit/{id}', [AkunController::class, 'edit'])->name('akun/edit');
    Route::post('/akun/update/{id}', [AkunController::class, 'update'])->name('akun/update');
    Route::post('/akun/delete', [AkunController::class, 'delete'])->name('akun/delete');
    Route::get('get-akun-data', [AkunController::class, 'getAkun'])->name('get-akun-data');
});

Route::controller(BarangController::class)->group(function () {
    Route::get('barang/list/page', 'daftarBarang')->middleware('auth')->name('barang/list/page');
    Route::get('barang/add/new', 'tambahBarang')->middleware('auth')->name('barang/add/new');
    Route::post('form/barang/save', 'simpanBarang')->middleware('auth')->name('form/barang/save');
    Route::get('/barang/edit/{id}', [BarangController::class, 'editBarang'])->name('barang/edit');
    Route::post('/barang/update/{id}', [BarangController::class, 'updateBarang'])->name('barang/update');
    Route::post('/barang/delete', [BarangController::class, 'deleteBarang'])->name('barang/delete');
    Route::get('get-barang-data', [BarangController::class, 'dataBarang'])->name('get-barang-data');
});

Route::controller(BarangController::class)->group(function () {
    Route::get('barang/list/page', 'daftarBarang')->middleware('auth')->name('barang/list/page');
    Route::get('barang/add/new', 'tambahBarang')->middleware('auth')->name('barang/add/new');
    Route::post('form/barang/save', 'simpanBarang')->middleware('auth')->name('form/barang/save');
    Route::get('/barang/edit/{id}', [BarangController::class, 'editBarang'])->name('barang/edit');
    Route::post('/barang/update/{id}', [BarangController::class, 'updateBarang'])->name('barang/update');
    Route::post('/barang/delete', [BarangController::class, 'hapusBarang'])->name('barang/delete');
    Route::get('get-barang-data', [BarangController::class, 'dataBarang'])->name('get-barang-data');
});

Route::controller(ClusterController::class)->group(function () {
    Route::get('cluster/list/page', 'daftarCluster')->middleware('auth')->name('cluster/list/page');
    Route::get('cluster/add/new', 'tambahCluster')->middleware('auth')->name('cluster/add/new');
    Route::post('form/cluster/save', 'simpanCluster')->middleware('auth')->name('form/cluster/save');
    Route::get('/cluster/edit/{id}', [ClusterController::class, 'editCluster'])->name('cluster/edit');
    Route::post('/cluster/update/{id}', [ClusterController::class, 'updateCluster'])->name('cluster/update');
    Route::post('/cluster/delete', [ClusterController::class, 'hapusCluster'])->name('cluster/delete');
    Route::get('get-cluster-data', [ClusterController::class, 'dataCluster'])->name('get-cluster-data');
});

Route::controller(KonsumenController::class)->group(function () {
    Route::get('konsumen/list/page', 'daftarKonsumen')->middleware('auth')->name('konsumen/list/page');
    Route::get('konsumen/add/new', 'tambahKonsumen')->middleware('auth')->name('konsumen/add/new');
    Route::post('form/konsumen/save', 'simpanKonsumen')->middleware('auth')->name('form/konsumen/save');
    Route::get('/konsumen/edit/{id}', [KonsumenController::class, 'editKonsumen'])->name('konsumen/edit');
    Route::post('/konsumen/update/{id}', [KonsumenController::class, 'updateKonsumen'])->name('konsumen/update');
    Route::post('/konsumen/delete', [KonsumenController::class, 'hapusKonsumen'])->name('konsumen/delete');
    Route::get('get-konsumen-data', [KonsumenController::class, 'dataKonsumen'])->name('get-konsumen-data');
});

Route::controller(ProyekUmumController::class)->group(function () {
    Route::get('proyekumum/list/page', 'daftarProyekUmum')->middleware('auth')->name('proyekumum/list/page');
    Route::get('proyekumum/add/new', 'tambahProyekUmum')->middleware('auth')->name('proyekumum/add/new');
    Route::post('form/proyekumum/save', 'simpanProyekUmum')->middleware('auth')->name('form/proyekumum/save');
    Route::get('/proyekumum/edit/{id}', [ProyekUmumController::class, 'editProyekUmum'])->name('proyekumum/edit');
    Route::post('/proyekumum/update/{id}', [ProyekUmumController::class, 'updateProyekUmum'])->name('proyekumum/update');
    Route::post('/proyekumum/delete', [ProyekUmumController::class, 'hapusProyekUmum'])->name('proyekumum/delete');
    Route::get('get-proyekumum-data', [ProyekUmumController::class, 'dataProyekUmum'])->name('get-proyekumum-data');
});

Route::controller(PenyesuaianBarangController::class)->group(function () {
    Route::get('penyesuaian/list/page', 'daftarPenyesuaian')->middleware('auth')->name('penyesuaian/list/page');
    Route::get('penyesuaian/add/new', 'tambahPenyesuaian')->middleware('auth')->name('penyesuaian/add/new');
    Route::post('form/penyesuaian/save', 'simpanPenyesuaian')->middleware('auth')->name('form/penyesuaian/save');
    Route::get('/penyesuaian/edit/{id}/{penyesuaian_id}', 'editPenyesuaian')->middleware('auth')->name('penyesuaian/edit');
    Route::post('/penyesuaian/update/{id}/{penyesuaian_id}', 'updatePenyesuaian')->middleware('auth')->name('penyesuaian/update');
    Route::post('/penyesuaian/delete', 'hapusPenyesuaian')->middleware('auth')->name('penyesuaian/delete');
    Route::get('get-penyesuaian-data', 'dataPenyesuaian')->name('get-penyesuaian-data');
    // (opsional) API untuk ambil data barang
    Route::get('/barang/search', 'searchBarang')->middleware('auth')->name('barang/search');
});

