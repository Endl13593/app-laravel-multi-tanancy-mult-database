<?php

namespace App\Http\Controllers\Tenant;

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
            'name' => 'Empresa ' . $random,
            'domain' => 'empresa' . $random . '.multitenancy.local',
            'db_database' => 'db_empresa' . $random,
            'db_hostname' => 'mysql',
            'db_username' => 'root',
            'db_password' => 'root'
        ]);

        dd($tenant);
    }
}
