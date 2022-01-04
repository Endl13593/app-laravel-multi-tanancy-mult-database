<?php

namespace App\Console\Commands\Tenant;

use App\Models\Tenant;
use App\Services\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{
    protected ManagerTenant $managerTenant;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrations {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations Tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $managerTenant)
    {
        parent::__construct();

        $this->managerTenant = $managerTenant;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $this->managerTenant->setConnection($tenant);

            $this->info("Connecting Tenant {$tenant->name}");

            Artisan::call($command, [
                '--force' => true,
                '--path'  => '/database/migrations/tenant',
            ]);

            $this->info("End Connecting Tenant {$tenant->name}");
            $this->info('-------------------------------------');
        }
    }
}
