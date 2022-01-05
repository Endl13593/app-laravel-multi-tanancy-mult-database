<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\TenantCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function store(Request $request)
    {
        $random = Str::random(5);

        $tenant = $this->tenant->create([
            'name' => strtolower('Empresa ' . $random),
            'domain' => strtolower('empresa' . $random . '.multitenancy.local'),
            'db_database' => 'db_empresaxysde',
            'db_hostname' => 'mysql',
            'db_username' => 'root',
            'db_password' => 'root'
        ]);

        if (true)
            event(new TenantCreated($tenant));
        else
            event(new DatabaseCreated($tenant));

        dd($tenant);
    }
}
