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

// ===================== HALAMAN UTAMA =====================
Route::get('/landing', function () {
    return view('welcome');
});

// ===================== LOGIN / REGISTER =====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Auth::routes(); // untuk logout, forgot password, dll

// ===================== HALAMAN SETELAH LOGIN =====================
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ===================== PROFIL (semua role) =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// ===================== ADMIN =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard admin (statistik & diagram proposal)
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Status pengajuan proposal
    Route::get('/status-pengajuan', [AdminController::class, 'statusPengajuan'])->name('admin.status-pengajuan');

    // Aksi proposal
    Route::post('/proposals/{id}/accept', [AdminController::class, 'acceptProposal'])->name('admin.proposal.accept');
    Route::post('/proposals/{id}/reject', [AdminController::class, 'rejectProposal'])->name('admin.proposal.reject');
    Route::post('/proposals/{id}/revision', [AdminController::class, 'revisionProposal'])->name('admin.proposal.revision');

    // Manajemen user
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.create-user');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.store-user');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

    // Ekspor data proposal (daily, weekly, monthly, yearly)
    Route::get('/proposals/export', [AdminController::class, 'exportProposals'])->name('proposals.export');
    
});

// ===================== MASYARAKAT =====================
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/', [DashboardController::class, 'masyarakat'])->name('masyarakat.dashboard');
});

// ===================== STAKEHOLDER =====================
Route::middleware(['auth', 'role:stakeholder,admin'])->group(function () {
    Route::get('/', [StakeholderController::class, 'dashboard'])->name('stakeholder.dashboard');

    // Evaluasi proposal
    Route::get('/evaluate/{id}', [StakeholderController::class, 'evaluateForm'])->name('stakeholder.evaluate.form');
    Route::post('/evaluate/{id}', [StakeholderController::class, 'evaluateStore'])->name('stakeholder.evaluate.store');

    // Lihat daftar dan riwayat evaluasi
    Route::get('/evaluate', [StakeholderController::class, 'evaluateList'])->name('stakeholder.evaluate');
    Route::get('/history', [StakeholderController::class, 'history'])->name('stakeholder.history');
});

// ===================== PROPOSAL (untuk semua user login) =====================
Route::middleware(['auth'])->group(function () {
    Route::get('proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('proposals', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('proposals/{id}', [ProposalController::class, 'show'])->name('proposals.show');
    Route::get('proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('proposals/{id}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('proposals/{id}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
    Route::post('proposals/{id}/submit', [ProposalController::class, 'submit'])->name('proposals.submit');

    // Ekspor proposal berdasarkan filter waktu
    Route::get('/proposals/export/filtered', [ProposalExportController::class, 'exportFiltered'])->name('proposals.export.filtered');
});

// ===================== MASTER DATA (ADMIN) =====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('kabupatens', KabupatenController::class);
    Route::resource('kecamatans', KecamatanController::class);
    Route::resource('desas', DesaController::class);
});

// Form Contact Us (halaman depan)
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

// Halaman admin melihat pesan (hanya untuk admin)
Route::get('/admin/contacts', [ContactController::class, 'index'])
    ->middleware(['auth', 'isAdmin'])
    ->name('admin.contacts.index');

