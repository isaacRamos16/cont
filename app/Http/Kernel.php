<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// ✅ Agrega los use necesarios
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Http\Middleware\VerifyCsrfToken;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\CheckUserAccess;

class Kernel extends HttpKernel
{
    /**
     * Define las clases middleware globales.
     */
    protected $middleware = [
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware agrupado por grupos como "web" o "api".
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
            VerifyCsrfToken::class,
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            ThrottleRequests::class,
            SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware individuales registrados.
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'verified' => EnsureEmailIsVerified::class,
        'check.user.access' => CheckUserAccess::class, // Tu middleware personalizado
    ];
}
