<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ForbiddenController;
use App\Http\Controllers\MyProjectController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\SidebarController;
use App\Http\Middleware\isAdmin;

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
    return view('index');
});
Route::get('/login', function () {
    return view('index');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/forbidden', [ForbiddenController::class, 'index'])->name('forbidden');
Route::get('/sidebar', [SidebarController::class, 'index'])->name('sidebar');

Route::prefix('pengaturan')->middleware('isAdmin')->group(function () {
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi');
    Route::get('/divisi-add', [DivisiController::class, 'add'])->name('divisi-add');
    Route::post('/divisi', [DivisiController::class, 'store'])->name('divisi-store');
    Route::post('/divisi-delete', [DivisiController::class, 'delete'])->name('divisi-delete');
    Route::get('/divisi-edit/{id}', [DivisiController::class, 'edit'])->name('divisi-edit');
    Route::post('/divisi-update/{id}', [DivisiController::class, 'update'])->name('divisi-update');

    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::get('/unit-add', [UnitController::class, 'add'])->name('unit-add');
    Route::post('/unit', [UnitController::class, 'store'])->name('unit-store');
    Route::post('/unit-delete', [UnitController::class, 'delete'])->name('unit-delete');
    Route::get('/unit-edit/{id}', [UnitController::class, 'edit'])->name('unit-edit');
    Route::post('/unit-update/{id}', [UnitController::class, 'update'])->name('unit-update');

    Route::get('/akses', [AksesController::class, 'index'])->name('akses');
    Route::get('/akses-add', [AksesController::class, 'add'])->name('akses-add');
    Route::post('/akses', [AksesController::class, 'store'])->name('akses-store');
    Route::post('/akses-delete', [AksesController::class, 'delete'])->name('akses-delete');
    Route::get('/akses-edit/{id}', [AksesController::class, 'edit'])->name('akses-edit');
    Route::post('/akses-update/{id}', [AksesController::class, 'update'])->name('akses-update');

    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/role-add', [RoleController::class, 'add'])->name('role-add');
    Route::post('/role', [RoleController::class, 'store'])->name('role-store');
    Route::post('/role-delete', [RoleController::class, 'delete'])->name('role-delete');
    Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role-edit');
    Route::post('/role-update/{id}', [RoleController::class, 'update'])->name('role-update');
    Route::get('/role-access/{id}', [RoleController::class, 'access'])->name('role-access');
    Route::post('/role-access', [RoleController::class, 'accessStore'])->name('role-access-store');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna-add', [PenggunaController::class, 'add'])->name('pengguna-add');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna-store');
    Route::post('/pengguna-delete', [PenggunaController::class, 'delete'])->name('pengguna-delete');
    Route::get('/pengguna-edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna-edit');
    Route::post('/pengguna-update/{id}', [PenggunaController::class, 'update'])->name('pengguna-update');


    Route::get('/level', [LevelController::class, 'index'])->name('level');
    Route::get('/level-add', [LevelController::class, 'add'])->name('level-add');
    Route::post('/level', [LevelController::class, 'store'])->name('level-store');
    Route::post('/level-delete', [LevelController::class, 'delete'])->name('level-delete');
    Route::get('/level-edit/{id}', [LevelController::class, 'edit'])->name('level-edit');
    Route::post('/level-update/{id}', [LevelController::class, 'update'])->name('level-update');
});
Route::prefix('project')->middleware('isCheckMenu')->group(function () {
    Route::get("/project", [ProjectController::class, 'index'])->name('project');
    Route::get('/project-add', [ProjectController::class, 'add'])->name('project-add');
    Route::post('/project', [ProjectController::class, 'store'])->name('proses-project-store');
    Route::get('/project-detail/{slug}', [ProjectController::class, 'detail'])->name('project-detail');
    Route::post('/project-delete', [ProjectController::class, 'delete'])->name('proses-project-delete');

    //tambah member
    Route::get('/project-tambah-member/{slug}', [ProjectController::class, 'tambahMember'])->name('project-tambah-member');
    Route::post('/project-store-member', [ProjectController::class, 'storeMember'])->name('proses-project-store-member');
    Route::post('/project-hapus-member', [ProjectController::class, 'hapusMember'])->name('proses-project-hapus-member');

    //tambah task
    Route::get('/project-tambah-task/{slug}', [ProjectController::class, 'tambahTask'])->name('project-tambah-task');
    Route::post('/project-store-task', [ProjectController::class, 'storeTask'])->name('proses-project-store-task');
    Route::get('/project-edit-task/{slug}/{id}', [ProjectController::class, 'editTask'])->name('project-edit-task');
    Route::post('/project-update-task/{id}', [ProjectController::class, 'updateTask'])->name('proses-project-update-task');
    Route::post('/project-delete-task', [ProjectController::class, 'deleteTask'])->name('proses-project-delete-task');
    Route::get('/project-detail-task/{slug}/{kodeproject}/{kodepengguna}', [ProjectController::class, 'detailTask'])->name('project-detail-task');

    //menu project ku
    Route::get("/my-project", [MyProjectController::class, 'index'])->name('my-project');
    Route::get("/my-project-task/{slug}", [MyProjectController::class, 'daftarTask'])->name('my-project-task');
    Route::post("/my-project-update-status", [MyProjectController::class, 'updateTask'])->name('proses-my-project-update-task');
});

Route::prefix('pekerjaan')->middleware('isCheckMenu')->group(function () {
    Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan');
    Route::post('/pekerjaan-delete', [PekerjaanController::class, 'delete'])->name('proses-pekerjaan-delete');
    Route::get('/pekerjaan-add', [PekerjaanController::class, 'add'])->name('pekerjaan-add');
    Route::post('/pekerjaan-store', [PekerjaanController::class, 'store'])->name('proses-pekerjaan-store');
});
