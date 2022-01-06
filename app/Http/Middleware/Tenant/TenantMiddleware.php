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
        $managerTenant = app(ManagerTenant::class);

        if ($managerTenant->domainIsMain())
            return $next($request);

        $tenant = $this->getTenant($request->getHost());

        if (!$tenant && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if ($request->url() != route('404.tenant') && !$managerTenant->domainIsMain()){
            $managerTenant->setConnection($tenant);

            $this->setSessionTenant($tenant->only(['name']));
        }

        return $next($request);
    }

    private function getTenant(string $domain)
    {
        return Tenant::where('domain', $domain)->first();
    }

    private function setSessionTenant(array $tenant)
    {
        session()->put('tenant', $tenant);
    }
}
