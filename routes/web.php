<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\KelasController;

Route::redirect('/', '/login');

Route::middleware(['auth', 'is_siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::view('dashboard', 'dashboard.siswa')->name('dashboard');

    Route::controller(ComplaintController::class)->group(function () {
        Route::get('complaints', 'siswaList')->name('complaints.index');
        Route::get('complaints/create', 'siswaCreate')->name('complaints.create');
        Route::post('complaints', 'siswaStore')->name('complaints.store');
        Route::get('complaints/{complaint}', 'siswaShow')->name('complaints.show');
    });
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'dashboard.admin')->name('dashboard');

    Route::controller(ComplaintController::class)->group(function () {
        Route::get('complaints', 'adminList')->name('complaints.index');
        Route::get('complaints/{complaint}', 'adminShow')->name('complaints.show');
        Route::patch('complaints/{complaint}/status', 'adminUpdateStatus')->name('complaints.status');
        Route::patch('complaints/{complaint}/feedback', 'adminUpdateFeedback')->name('complaints.feedback');
    });

    Route::resource('kelas', KelasController::class)->names('kelas')->except('show');

    Route::controller(AdminUserController::class)->group(function () {
        Route::get('siswa-pending', 'index')->name('users.pending');
        Route::post('siswa/{siswa}/approve', 'approve')->name('users.approve');
        Route::get('siswa/create', 'create')->name('users.create');
        Route::post('siswa', 'store')->name('users.store');
        Route::get('siswa-data', 'dataSiswa')->name('users.data');
        Route::delete('siswa/{siswa}', 'deleteSiswa')->name('users.destroy');
    });
});

require __DIR__.'/auth.php';
