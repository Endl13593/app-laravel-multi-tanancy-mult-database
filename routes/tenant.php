<?php

use App\Http\Controllers\Tenant\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/create', [TenantController::class, 'create'])->name('tenant.create');
Route::post('/store', [TenantController::class, 'store'])->name('tenant.store');
Route::get('/edit/{domain}', [TenantController::class, 'edit'])->name('tenant.edit');
Route::put('/update/{id}', [TenantController::class, 'update'])->name('tenant.update');
Route::get('/{domain}', [TenantController::class, 'show'])->name('tenant.show');
Route::delete('/destroy/{id}', [TenantController::class, 'destroy'])->name('tenant.destroy');

Route::get('/', [TenantController::class, 'index'])->name('tenant.index');
