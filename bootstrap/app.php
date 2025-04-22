<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DapurMiddleware;
use App\Http\Middleware\KasirMiddleware;
use App\Http\Middleware\PelayanMiddleware;
use App\Http\Middleware\PemilikMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
      ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'dapur' => DapurMiddleware::class,
            'kasir' => KasirMiddleware::class,
            'pelayan' => PelayanMiddleware::class,
            'pemilik' => PemilikMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
