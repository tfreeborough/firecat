<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.vendor' => \App\Http\Middleware\VendorAuth::class,
        'auth.vendor.owns_deal' => \App\Http\Middleware\OrganisationOwnsDeal::class,
        'auth.vendor.owns_opportunity' => \App\Http\Middleware\OrganisationOwnsOpportunity::class,
        'auth.vendor.owns_tag' => \App\Http\Middleware\OrganisationOwnsTag::class,
        'auth.vendor.assigned_opportunity' => \App\Http\Middleware\UserAssignedOpportunity::class,
        'auth.vendor.assigned_deal' => \App\Http\Middleware\UserAssignedDeal::class,
        'auth.partner' => \App\Http\Middleware\PartnerAuth::class,
        'auth.partner.has_opportunity' => \App\Http\Middleware\PartnerHasOpportunity::class,
        'auth.partner.has_deal' => \App\Http\Middleware\PartnerHasDeal::class,
        'auth.verified' => \App\Http\Middleware\EmailVerified::class,
        'auth.admin' => \App\Http\Middleware\AdminAuth::class,
        'auth.vendor_admin' => \App\Http\Middleware\VendorAdmin::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'opportunity.not.rejected' => \App\Http\Middleware\OpportunityNotRejected::class,
    ];
}
