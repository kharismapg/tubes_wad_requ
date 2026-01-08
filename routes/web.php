<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // --- 1. DASHBOARD (Public for all authenticated users) ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- 2. POST MANAGEMENT (Student & Organizer) ---
    // IMPORTANT: Specific routes must come BEFORE dynamic routes
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('post.my-posts');
    Route::get('/my-archive', [PostController::class, 'archive'])->name('post.archive');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    // Dynamic route with {id} must come AFTER specific routes
    Route::get('/post/{id}', [DashboardController::class, 'show'])->name('post.show');

    // --- 3. BOOKMARKS ---
    Route::post('/bookmark/{id}', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
    Route::get('/my-bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    // --- 4. NOTIFICATIONS ---
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

    // --- 5. REPORTS ---
    Route::get('/report/{postId}', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/{postId}', [ReportController::class, 'store'])->name('report.store');

    // --- 6. ADMIN PANEL (Admin only) ---
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
        Route::get('/archive', [AdminController::class, 'archive'])->name('admin.archive');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
        Route::post('/reports/{id}/resolve', [AdminController::class, 'resolveReport'])->name('admin.reports.resolve');
        Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    });

    // --- 7. PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.picture.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';