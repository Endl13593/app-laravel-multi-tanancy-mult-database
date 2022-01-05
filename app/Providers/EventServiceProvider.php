<?php

namespace App\Providers;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\TenantCreated;
use App\Listeners\Tenant\CreateTenantDatabase;
use App\Listeners\Tenant\RunMigrationsTenant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TenantCreated::class => [
            CreateTenantDatabase::class
        ],
        DatabaseCreated::class => [
            RunMigrationsTenant::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
