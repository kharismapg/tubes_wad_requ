<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
        // 1. Auth (Biar bisa Login/Register/Logout di Postman)
            'login',
            'register',
            'logout',
        // 2. Fitur Utama (Biar bisa CRUD tanpa token)
            'post/*',      // Upload, Edit, Hapus
            'bookmark/*',  // Simpan/Hapus Koleksi
            'report/*',    // Lapor
            'admin/*',     // Verifikasi Admin
            'notifications/*', // Baca Notif
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();