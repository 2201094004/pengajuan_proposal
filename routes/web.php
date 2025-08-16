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
| PUBLIC (Landing & Kontak)
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome');
Route::view('/landing', 'welcome');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Login & Register)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Auth::routes(); // include logout, reset, etc.

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| PROFILE (Semua Role)
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
    Route::get('/', [DashboardController::class, 'admin'])->name('dashboard');

    // Proposal
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('status-pengajuan');
    Route::post('/proposals/{id}/accept', [AdminController::class, 'acceptProposal'])->name('proposal.accept');
    Route::post('/proposals/{id}/reject', [AdminController::class, 'rejectProposal'])->name('proposal.reject');
    Route::post('/proposals/{id}/revision', [AdminController::class, 'revisionProposal'])->name('proposal.revision');
    Route::get('/proposals/{id}/penilaian', [ProposalController::class, 'penilaian'])->name('proposals.penilaian');

    // User Management
    Route::resource('users', AdminController::class)->only([]); // Optional, already defined below
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('manage-users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('store-user');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('edit-user');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('update-user');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
    Route::get('/admin/list-user', [AdminController::class, 'index'])->name('admin.list-user');
    Route::get('/admin/proposals/{id}/history', [AdminController::class, 'history'])->name('admin.proposals.history');

    // Jenis Proposal
    Route::resource('jenis_proposals', JenisProposalController::class); // admin.jenis_proposals.*

    // Ekspor Proposal
    Route::get('/export/proposals', [ProposalController::class, 'exportFiltered'])->name('proposals.export');
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('proposals.export.pdf');

    // Master Data
    Route::resource('kabupatens', KabupatenController::class);
    Route::resource('kecamatans', KecamatanController::class);
    Route::resource('desas', DesaController::class);

    // Pesan Masuk
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
    Route::get('/evaluate', [StakeholderController::class, 'evaluateList'])->name('evaluate');
    Route::get('/evaluate/{id}', [StakeholderController::class, 'evaluateForm'])->name('evaluate.form');
    Route::post('/evaluate/{id}', [StakeholderController::class, 'evaluateStore'])->name('evaluate.store');
    Route::get('/history', [StakeholderController::class, 'history'])->name('history');
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('status-pengajuan');
    Route::get('/proposals', [AdminController::class, 'statusPengajuan'])->name('proposals');
    Route::get('/export/proposals/excel', [ProposalController::class, 'exportFilteredExcel'])->name('proposals.export.excel');
    Route::get('/export/proposals/pdf', [ProposalController::class, 'exportPdf'])->name('proposals.export.pdf');
});

/*
|--------------------------------------------------------------------------
| PROPOSAL (Semua yang Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class)->except(['penilaian']);
    Route::post('proposals/{id}/submit', [ProposalController::class, 'submit'])->name('proposals.submit');
    Route::get('/proposals/export/filtered', [ProposalExportController::class, 'exportFiltered'])->name('proposals.export.filtered');
});

/*
|--------------------------------------------------------------------------
| STAKEHOLDER (Dobel Cek)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:stakeholder'])->prefix('stakeholder')->group(function () {
    Route::get('/dashboard', [StakeholderController::class, 'index'])->name('stakeholders.dashboard');
    Route::get('/proposals', [StakeholderController::class, 'semuaProposal'])->name('stakeholder.proposals');
    Route::get('/status-pengajuan', [StakeholderController::class, 'statusPengajuan'])->name('stakeholder.status-pengajuan');
});
