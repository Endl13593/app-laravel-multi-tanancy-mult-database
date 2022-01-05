<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\TenantCreated;
use App\Services\Tenant\Database\DatabaseManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Exception;

class CreateTenantDatabase
{
    protected DatabaseManager $databaseManager;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Handle the event.
     *
     * @param TenantCreated $event
     * @return void
     * @throws Exception
     */
    public function handle(TenantCreated $event)
    {
        $tenant = $event->tenant();

        if (!$this->databaseManager->createDatabase($tenant)) {
            throw new Exception('Error create database');
        }

        // Run migrations
        event(new DatabaseCreated($tenant));
    }
}
