<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Nova Empresa') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col mt-3 items-center sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('tenant.store') }}">
                @csrf

                <!-- Name Tenant -->
                <div>
                    <x-label for="name" :value="__('Nome da empresa')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                </div>

                <!-- Domain Tenant -->
                <div class="mt-4">
                    <x-label for="domain" :value="__('Nome do domínio')" />

                    <x-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" />
                </div>

                <!-- Database Tenant -->
                <div class="mt-4">
                    <x-label for="db_database" :value="__('Nome do banco de dados')" />

                    <x-input id="db_database" class="block mt-1 w-full" type="text" name="db_database" :value="old('db_database')" />
                </div>

                <!-- Host Tenant -->
                <div class="mt-4">
                    <x-label for="db_hostname" :value="__('Nome do host')" />

                    <x-input id="db_hostname" class="block mt-1 w-full" type="text" name="db_hostname" :value="old('db_hostname')" />
                </div>

                <!-- Username Tenant -->
                <div class="mt-4">
                    <x-label for="db_username" :value="__('Nome do username')" />

                    <x-input id="db_username" class="block mt-1 w-full" type="text" name="db_username" :value="old('db_username')" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="db_password" :value="__('Senha')" />

                    <x-input id="db_password" class="block mt-1 w-full"
                             type="password"
                             name="db_password" />
                </div>

                <!-- Create database true/false -->
                <div class="mt-4">
                    <label class="text-gray-700">
                        <x-input type="checkbox" name="create_database" :value="old('create_database')" checked/>
                        <span class="ml-1">Criar banco de dados?</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Cadastrar') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
