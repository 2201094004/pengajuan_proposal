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
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));
Route::get('/landing', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Auth::routes(); // Termasuk logout, lupa password, dll

/*
|--------------------------------------------------------------------------
| HALAMAN SETELAH LOGIN
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
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');
    

    // Status Pengajuan Proposal
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('admin.status-pengajuan');

    // Aksi Proposal (terima/tolak/revisi)
    Route::post('/proposals/{id}/accept', [AdminController::class, 'acceptProposal'])->name('admin.proposal.accept');
    Route::post('/proposals/{id}/reject', [AdminController::class, 'rejectProposal'])->name('admin.proposal.reject');
    Route::post('/proposals/{id}/revision', [AdminController::class, 'revisionProposal'])->name('admin.proposal.revision');

    // Lembar Penilaian
    Route::get('/proposals/{id}/penilaian', [ProposalController::class, 'penilaian'])->name('admin.proposals.penilaian');

    // Manajemen Pengguna
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.create-user');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.store-user');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

    // Jenis Proposal
    Route::resource('jenis-proposals', JenisProposalController::class);

    // Ekspor
    Route::get('/export/proposals', [ProposalController::class, 'exportFiltered'])->name('admin.proposals.export');
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('admin.proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('admin.proposals.export.pdf');

    // Master Data
    Route::resource('kabupatens', KabupatenController::class);
    Route::resource('kecamatans', KecamatanController::class);
    Route::resource('desas', DesaController::class);

    // Lihat pesan
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
});

/*
|--------------------------------------------------------------------------
| MASYARAKAT
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/', [DashboardController::class, 'masyarakat'])->name('masyarakat.dashboard');
});

/*
|--------------------------------------------------------------------------
| STAKEHOLDER & ADMIN (Evaluasi Proposal)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:stakeholder,admin'])->prefix('stakeholder')->group(function () {
    Route::get('/', [StakeholderController::class, 'dashboard'])->name('stakeholder.dashboard');

    // Form Penilaian
    Route::get('/evaluate/{id}', [StakeholderController::class, 'evaluateForm'])->name('stakeholder.evaluate.form');
    Route::post('/evaluate/{id}', [StakeholderController::class, 'evaluateStore'])->name('stakeholder.evaluate.store');

    // List Evaluasi & History
    Route::get('/evaluate', [StakeholderController::class, 'evaluateList'])->name('stakeholder.evaluate');
    Route::get('/history', [StakeholderController::class, 'history'])->name('stakeholder.history');

    // Melihat status pengajuan
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('stakeholder.status-pengajuan');
    Route::get('/proposals', [AdminController::class, 'statusPengajuan'])->name('stakeholder.proposals');

    // Export oleh stakeholder
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('stakeholder.proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('stakeholder.proposals.export.pdf');
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

/*
|--------------------------------------------------------------------------
| FORM KONTAK (Publik)
|--------------------------------------------------------------------------
*/
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');
