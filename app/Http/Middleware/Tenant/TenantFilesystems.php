<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use Illuminate\Http\Request;

class TenantFilesystems
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
        if ($request->getHost() !== config('tenant.domain_main')) {
            if (!$this->setConfig()) {
                abort(403);
            }
        }

        return $next($request);
    }

    private function setConfig(): bool
    {
        if (isset(session('tenant')['uuid'])) {
            $uuid = session('tenant')['uuid'];

            config()->set([
                'filesystems.disks.tenant.root' => config('filesystems.disks.tenant.root') . "/{$uuid}",
                'filesystems.disks.tenant.url'  => config('filesystems.disks.tenant.url') . "/{$uuid}"
            ]);

            return true;
        }

        return false;
    }
}
