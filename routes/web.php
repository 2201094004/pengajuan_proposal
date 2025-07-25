<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProposalExportController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JenisProposalController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM (Landing Page & Kontak)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));
Route::get('/landing', fn() => view('welcome'));

// FORM KONTAK (Publik)
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Auth::routes(); // Termasuk logout, reset password, dll

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| PROFIL (Semua Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'admin'])->name('dashboard');

    // Status Pengajuan Proposal
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('status-pengajuan');

    // Aksi Proposal (terima, tolak, revisi)
    Route::post('/proposals/{id}/accept', [AdminController::class, 'acceptProposal'])->name('proposal.accept');
    Route::post('/proposals/{id}/reject', [AdminController::class, 'rejectProposal'])->name('proposal.reject');
    Route::post('/proposals/{id}/revision', [AdminController::class, 'revisionProposal'])->name('proposal.revision');

    // Penilaian Proposal
    Route::get('/proposals/{id}/penilaian', [ProposalController::class, 'penilaian'])->name('proposals.penilaian');

    // Manajemen Pengguna
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('manage-users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('store-user');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('edit-user');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('update-user');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');

    // Jenis Proposal
    Route::resource('jenis-proposals', JenisProposalController::class); // admin.jenis-proposals.*

    // Ekspor Proposal
    Route::get('/export/proposals', [ProposalController::class, 'exportFiltered'])->name('proposals.export');
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('proposals.export.pdf');

    // Master Data
    // Route::resource('kabupatens', KabupatenController::class);     // admin.kabupatens.*
    Route::resource('kabupatens', KabupatenController::class);
    Route::resource('kecamatans', KecamatanController::class);     // admin.kecamatans.*
    Route::resource('desas', DesaController::class);               // admin.desas.*

    // Pesan Masuk (Kontak)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

/*
|--------------------------------------------------------------------------
| MASYARAKAT
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/', [DashboardController::class, 'masyarakat'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| STAKEHOLDER & ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:stakeholder,admin'])->prefix('stakeholder')->name('stakeholder.')->group(function () {
    Route::get('/', [StakeholderController::class, 'dashboard'])->name('dashboard');

    // Penilaian Proposal
    Route::get('/evaluate/{id}', [StakeholderController::class, 'evaluateForm'])->name('evaluate.form');
    Route::post('/evaluate/{id}', [StakeholderController::class, 'evaluateStore'])->name('evaluate.store');

    Route::get('/evaluate', [StakeholderController::class, 'evaluateList'])->name('evaluate');
    Route::get('/history', [StakeholderController::class, 'history'])->name('history');

    // Melihat pengajuan
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('status-pengajuan');
    Route::get('/proposals', [AdminController::class, 'statusPengajuan'])->name('proposals');

    // Ekspor Proposal
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('proposals.export.pdf');
});

/*
|--------------------------------------------------------------------------
| PROPOSAL (Untuk Semua Role Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('proposals', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('proposals/{id}', [ProposalController::class, 'show'])->name('proposals.show');
    Route::get('proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('proposals/{id}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('proposals/{id}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
    Route::post('proposals/{id}/submit', [ProposalController::class, 'submit'])->name('proposals.submit');

    // Ekspor umum
    Route::get('/proposals/export/filtered', [ProposalExportController::class, 'exportFiltered'])->name('proposals.export.filtered');
});

// Stakeholder routes
Route::prefix('stakeholder')->name('stakeholder.')->middleware(['auth', 'role:stakeholder'])->group(function () {
    Route::get('/dashboard', [StakeholderController::class, 'index'])->name('dashboard');

    Route::get('/proposals', [StakeholderController::class, 'semuaProposal'])->name('proposals');
    Route::get('/status-pengajuan', [StakeholderController::class, 'statusPengajuan'])->name('status-pengajuan');
});

Route::get('/stakeholder/dashboard', [StakeholderController::class, 'dashboard'])->name('stakeholders.dashboard');
