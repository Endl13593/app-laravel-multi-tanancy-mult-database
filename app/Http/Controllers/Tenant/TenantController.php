<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Events\Tenant\TenantCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreUpdateTenantFormRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    protected Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function index()
    {
        $tenants = $this->tenant->latest()->get();

        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(StoreUpdateTenantFormRequest $request)
    {
        $data = [
            'name' => strtoupper($request->name),
            'domain' => strtolower($request->domain),
            'db_database' => strtolower($request->db_database),
            'db_hostname' => strtolower($request->db_hostname),
            'db_username' => strtolower($request->db_username),
            'db_password' => strtolower($request->db_password),
        ];

        $tenant = $this->tenant->create($data);

        if ($request->has('create_database'))
            event(new TenantCreated($tenant));
        else
            event(new DatabaseCreated($tenant));

        return redirect()->route('tenant.index')->with('success', 'Você acabou de cadastrar uma nova empresa!');
    }

    public function edit(string $domain)
    {
        if (!$tenant = $this->tenant->where('domain', $domain)->first()) {
            return redirect()->back();
        }

        return view('tenants.edit', compact('tenant'));
    }

    public function update(StoreUpdateTenantFormRequest $request, int $id)
    {
        if (!$tenant = $this->tenant->find($id))
            return redirect()->back()->withInput();

        $tenant->update($request->validated());

        return redirect()->route('tenant.index')->with('success', 'Empresa atualizada com sucesso');
    }

    public function show(string $domain)
    {
        if (!$tenant = $this->tenant->where('domain', $domain)->first()) {
            return redirect()->back();
        }

        return view('tenants.show', compact('tenant'));
    }

    public function destroy(int $id)
    {
        if (!$tenant = $this->tenant->find($id)) {
            return redirect()->back();
        }

        $tenant->delete();

        return redirect()->route('tenant.index')->with('success', 'Empresa deletada com sucesso!');
    }
}
