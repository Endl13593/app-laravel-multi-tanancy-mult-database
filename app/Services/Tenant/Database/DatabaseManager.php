<?php

namespace App\Services\Tenant\Database;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    public function createDatabase(Tenant $tenant): bool
    {
        return DB::statement("
            CREATE DATABASE {$tenant->db_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ");
    }
}
