<?php

use App\Http\Controllers\Tenant\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/store', [TenantController::class, 'store'])->name('tenant.store');

Route::get('/', function() {
    return 'Tenant';
});