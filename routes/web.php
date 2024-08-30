<?php

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\LainnyaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SektorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MitraListController;
use App\Http\Controllers\KeagamaanController;
use App\Http\Controllers\SosialController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\InfrastrukturController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\LingkunganController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\ProyekController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SektorAdminController;
use App\Http\Controllers\KegiatanAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardProyekController;
use App\Http\Controllers\StatsDownloadController;

// Website Routes
Route::get('/', function () {
    return view('home');
})->name('home');
Route::resource('/', HomeController::class);

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
Route::resource('/tentang', TentangController::class);

Route::get('/statistik', function () {
    return view('stats');
})->name('stats');
Route::resource('/statistik', StatsController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
Route::post('/laporan/notif/{id}', [LaporanController::class, 'notif'])->name('laporan.notif');
Route::post('/laporan/notif2/{id}', [LaporanController::class, 'notif2'])->name('laporan.notif2');

Route::get('/sektor', function () {
    return view('sektor');
})->name('sektor');
Route::resource('/sektor', SektorController::class);
Route::get('/sektor/{id}', [SektorController::class, 'show'])->name('sektor.show');

Route::get('/sosial', function () {
    return view('sosial');
})->name('sosial');
Route::resource('/sosial', SosialController::class);
Route::get('/api/getProjects/{id}', [SosialController::class, 'getProjects']);

Route::get('/lingkungan', function () {
    return view('lingkungan');
})->name('lingkungan');
Route::resource('/lingkungan', LingkunganController::class);

Route::get('/kesehatan', function () {
    return view('kesehatan');
})->name('kesehatan');
Route::resource('/kesehatan', KesehatanController::class);

Route::get('/pendidikan', function () {
    return view('pendidikan');
})->name('pendidikan');
Route::resource('/pendidikan', PendidikanController::class);

Route::get('/infrastruktur', function () {
    return view('infrastruktur');
})->name('infrastruktur');
Route::resource('/infrastruktur', InfrastrukturController::class);

Route::get('/keagamaan', function () {
    return view('keagamaan');
})->name('keagamaan');
Route::resource('/keagamaan', KeagamaanController::class);

Route::get('/lainnya', function () {
    return view('lainnya');
})->name('lainnya');
Route::resource('/lainnya', LainnyaController::class);

Route::get('/mitra-list', function () {
    return view('mitra-list.index');
})->name('mitra-list');
Route::resource('/mitra-list', MitraListController::class);
Route::get('/mitra-list/{id}', [MitraListController::class, 'show'])->name('mitra-list.show');

Route::get('/kegiatan', function () {
    return view('kegiatan.index');
})->name('kegiatan');
Route::resource('/kegiatan', KegiatanController::class);
Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::get('/proyek/{id}', [ProyekController::class, 'show'])->name('proyek.show');

Route::get('/summary', [SummaryController::class, 'show'])->name('summary.show');
Route::get('/summary/edit/{id}', [SummaryController::class, 'edit'])->name('summary.edit');
Route::put('/summary/update/{id}', [SummaryController::class, 'update'])->name('summary.update');
Route::post('/summary/store', [SummaryController::class, 'store'])->name('summary.store');
Route::post('/summary/notif/{id}', [SummaryController::class, 'notif'])->name('summary.notif');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk laporan di dashboard
    Route::get('/dashboard/laporan', [DashboardLaporanController::class, 'laporan'])->name('dashboard.laporan');
    Route::get('/dashboard/laporan/create', [DashboardLaporanController::class, 'create'])
        ->middleware('can:create,App\Models\Laporan')
        ->name('dashboard.laporan.create');
    
    Route::post('/dashboard/laporan', [DashboardLaporanController::class, 'store'])->name('dashboard.laporan.store');
    
    Route::get('/dashboard/laporan/{laporan}', [DashboardLaporanController::class, 'show'])->name('dashboard.laporan.show');
    Route::put('/dashboard/laporan/{laporan}', [DashboardLaporanController::class, 'update'])->name('dashboard.laporan.update');
    Route::get('/dashboard/laporan/detail/{id}', [DashboardLaporanController::class, 'detail'])->name('dashboard.laporan.detail');
    Route::delete('/dashboard/laporan/{laporan}', [DashboardLaporanController::class, 'destroy'])->name('dashboard.laporan.destroy');
    Route::get('/dashboard/laporan/{laporan}/edit', [DashboardLaporanController::class, 'edit'])->name('dashboard.laporan.edit');
    Route::post('/dashboard/laporan/{laporan}/update-status', [DashboardLaporanController::class, 'updateStatus'])->name('dashboard.laporan.update-status')->middleware('auth');
    Route::delete('/dashboard/laporan/{laporan}/remove-image', [DashboardLaporanController::class, 'removeImage'])->name('dashboard.laporan.remove-image');

    // Tambahkan route baru ini
    Route::put('/dashboard/laporan/{laporan}/submit', [DashboardLaporanController::class, 'submit'])
        ->name('dashboard.laporan.submit')
        ->middleware('auth');

    // Rute untuk proyek di dashboard
    Route::get('/dashboard/proyek', [DashboardProyekController::class, 'proyek'])->name('dashboard.proyek');
        
    Route::get('/dashboard/proyek/create', [DashboardProyekController::class, 'create'])
        ->middleware('can:create,App\Models\proyek')
        ->name('dashboard.proyek.create');
    
    Route::post('/dashboard/proyek', [DashboardProyekController::class, 'store'])->name('dashboard.proyek.store');
    
    Route::get('/dashboard/proyek/{proyek}', [DashboardProyekController::class, 'show'])->name('dashboard.proyek.show');
    Route::put('/dashboard/proyek/{proyek}', [DashboardProyekController::class, 'update'])->name('dashboard.proyek.update');
    Route::get('/dashboard/proyek/detail/{id}', [DashboardProyekController::class, 'detail'])->name('dashboard.proyek.detail');
    Route::delete('/dashboard/proyek/{proyek}', [DashboardProyekController::class, 'destroy'])->name('dashboard.proyek.destroy');
    Route::get('/dashboard/proyek/{proyek}/edit', [DashboardProyekController::class, 'edit'])->name('dashboard.proyek.edit');
    Route::post('/dashboard/proyek/{proyek}/update-status', [DashboardProyekController::class, 'updateStatus'])->name('dashboard.proyek.update-status')->middleware('auth');
    Route::delete('/dashboard/proyek/{proyek}/remove-image', [DashboardProyekController::class, 'removeImage'])->name('dashboard.proyek.remove-image');

    // Tambahkan route baru ini
    Route::put('/dashboard/user/{user}/submit', [DashboardUserController::class, 'submit'])
        ->name('dashboard.user.submit')
        ->middleware('auth');

    // Rute untuk user di dashboard
    Route::get('/dashboard/user', [DashboardUserController::class, 'user'])->name('dashboard.user');
        
    Route::get('/dashboard/user/create', [DashboardUserController::class, 'create'])->middleware('auth')->name('dashboard.user.create');
        
    Route::post('/dashboard/user', [DashboardUserController::class, 'store'])->name('dashboard.user.store');
        
    Route::get('/dashboard/user/{user}', [DashboardUserController::class, 'show'])->name('dashboard.user.show');
    Route::put('/dashboard/user/{user}', [DashboardUserController::class, 'update'])->name('dashboard.user.update');
    Route::get('/dashboard/user/detail/{id}', [DashboardUserController::class, 'detail'])->name('dashboard.user.detail');
    Route::post('/user/{id}/activate', [DashboardUserController::class, 'active'])->name('user.active');
    Route::put('/dashboard/user/update/{id}', [DashboardUserController::class, 'update'])->name('user.update');
    Route::post('user/{id}/deactivate', [DashboardUserController::class, 'deactivateUser'])->name('user.deactivate');
    Route::delete('/dashboard/user/{user}', [DashboardUserController::class, 'destroy'])->name('dashboard.user.destroy');
    Route::get('/dashboard/user/{user}/edit', [DashboardUserController::class, 'edit'])->name('dashboard.user.edit');
    Route::post('/dashboard/user/{user}/update-status', [DashboardUserController::class, 'updateStatus'])->name('dashboard.user.update-status')->middleware('auth');
    Route::delete('/dashboard/user/{user}/remove-image', [DashboardUserController::class, 'removeImage'])->name('dashboard.user.remove-image');
    
    // Tambahkan route baru ini
    Route::put('/dashboard/user/{user}/submit', [DashboardUserController::class, 'submit'])
        ->name('dashboard.user.submit')
        ->middleware('auth');

    // Rute untuk sektor di dashboard
    Route::get('/dashboard/sektor', [SektorAdminController::class, 'index'])->name('dashboard.sektor.index');
    Route::get('/dashboard/sektor/create', [SektorAdminController::class, 'create'])->name('dashboard.sektor.create');
    Route::post('/dashboard/sektor', [SektorAdminController::class, 'store'])->name('dashboard.sektor.store');
    Route::get('/dashboard/sektor/{sektor}/edit', [SektorAdminController::class, 'edit'])->name('dashboard.sektor.edit');
    Route::put('/dashboard/sektor/{sektor}', [SektorAdminController::class, 'update'])->name('dashboard.sektor.update');
    Route::get('/dashboard/sektor/{sektor}', [SektorAdminController::class, 'show'])->name('dashboard.sektor.show');

    Route::get('/dashboard/sektor/{sektor}/program/{program}/edit', [SektorAdminController::class, 'editProgram'])->name('dashboard.sektor.program.edit');
    Route::put('/dashboard/sektor/{sektor}/program/{program}', [SektorAdminController::class, 'updateProgram'])->name('dashboard.sektor.program.update');

    // Rute untuk kegiatan di dashboard
    Route::get('/dashboard/kegiatan', [KegiatanAdminController::class, 'index'])->name('dashboard.kegiatan.index');
    Route::get('/dashboard/kegiatan/create', [KegiatanAdminController::class, 'create'])->name('dashboard.kegiatan.create');
    Route::post('/dashboard/kegiatan', [KegiatanAdminController::class, 'store'])->name('dashboard.kegiatan.store');
    Route::get('/dashboard/kegiatan/{kegiatan}/edit', [KegiatanAdminController::class, 'edit'])->name('dashboard.kegiatan.edit');
    Route::put('/dashboard/kegiatan/{kegiatan}', [KegiatanAdminController::class, 'update'])->name('dashboard.kegiatan.update');
    Route::delete('/dashboard/kegiatan/{kegiatan}', [KegiatanAdminController::class, 'destroy'])->name('dashboard.kegiatan.destroy');

    Route::get('/dashboard/user/download/csv', [DashboardUserController::class, 'downloadCsv'])->name('dashboard.user.download.csv');
    Route::get('/dashboard/user/download/pdf', [DashboardUserController::class, 'downloadPdf'])->name('dashboard.user.download.pdf');
});

// Email Verifications
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard/laporan/download/csv', [LaporanController::class, 'downloadCsv'])->name('dashboard.laporan.download.csv');
Route::get('/dashboard/laporan/download/pdf', [DashboardLaporanController::class, 'downloadPdf'])
    ->name('dashboard.laporan.download.pdf');

Route::get('/dashboard/proyek/download/csv', [DashboardProyekController::class, 'downloadCsv'])->name('dashboard.proyek.download.csv');
Route::get('/dashboard/proyek/download/pdf', [DashboardProyekController::class, 'downloadPdf'])->name('dashboard.proyek.download.pdf');

Route::post('/upload-image', [KegiatanAdminController::class, 'uploadImage'])->name('upload.image');

Route::get('/dashboard/kegiatan/{kegiatan}/detail', [KegiatanAdminController::class, 'detail'])->name('dashboard.kegiatan.detail');


Route::get('/dashboard/pengajuan', [PengajuanController::class, 'index'])->name('dashboard.pengajuan.index');
Route::get('/dashboard/pengajuan/{id}', [PengajuanController::class, 'show'])->name('dashboard.pengajuan.show');


Route::get('/dashboard/download/pdf', [DashboardController::class, 'downloadAdminPdf'])->name('dashboard.download.pdf');
Route::get('/dashboard/download/csv', [DashboardController::class, 'downloadAdminCsv'])->name('dashboard.download.csv');

Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::post('/pengajuan/notif/{id}', [PengajuanController::class, 'notif'])->name('pengajuan.notif');

// Rute untuk mitra
Route::get('/dashboard/mitra/download/pdf', [DashboardController::class, 'downloadMitraPdf'])->name('dashboard.mitra.download.pdf');
Route::get('/dashboard/mitra/download/csv', [DashboardController::class, 'downloadMitraCsv'])->name('dashboard.mitra.download.csv');

Route::get('/download-stats-pdf', [StatsDownloadController::class, 'downloadPdf'])->name('download.stats.pdf');
Route::get('/download-stats-csv', [StatsDownloadController::class, 'downloadCsv'])->name('download.stats.csv');

require __DIR__.'/auth.php';
