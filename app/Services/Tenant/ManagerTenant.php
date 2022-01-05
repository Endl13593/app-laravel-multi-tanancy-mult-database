<?php

namespace App\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{
    public function setConnection(Tenant $tenant)
    {
        DB::purge('tenant');

        config()->set('database.connections.tenant.host', $tenant->db_hostname);
        config()->set('database.connections.tenant.database', $tenant->db_database);
        config()->set('database.connections.tenant.username', $tenant->db_username);
        config()->set('database.connections.tenant.password', $tenant->db_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

    public function domainIsMain()
    {
        return request()->getHost() === config('tenant.domain_main');
    }
}
