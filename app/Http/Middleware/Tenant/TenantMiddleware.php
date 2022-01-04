<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Tenant;
use App\Services\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tenant = $this->getTenant($request->getHost());

        if (!$tenant && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if ($request->url() != route('404.tenant')){
            app(ManagerTenant::class)->setConnection($tenant);
        }

        return $next($request);
    }

    public function getTenant(string $domain)
    {
        return Tenant::where('domain', $domain)->first();
    }
}