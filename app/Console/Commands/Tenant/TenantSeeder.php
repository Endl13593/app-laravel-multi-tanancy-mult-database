<?php

namespace App\Console\Commands\Tenant;

use App\Models\Tenant;
use App\Services\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantSeeder extends Command
{
    protected ManagerTenant $managerTenant;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seed {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Seeders Tenants';

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
        if ($id = $this->argument('id')) {
            $tenant = Tenant::find($id);

            if (!$tenant) {
                $this->info("Tenant not found!");
                return;
            }

            $this->execCommand($tenant);

            return;
        }

        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $this->execCommand($tenant);
        }
    }

    private function execCommand(Tenant $tenant)
    {
        $this->managerTenant->setConnection($tenant);

        $this->info("Connecting Tenant {$tenant->name}");

        $artisan = Artisan::call('db:seed', [
            '--class'  => 'TenantsUserSeeder',
        ]);

        if ($artisan === 0) {
            $this->info("Seeders Run Success {$tenant->name}");
        }

        $this->info("End Connecting Tenant {$tenant->name}");
        $this->info('-------------------------------------');
    }
}
