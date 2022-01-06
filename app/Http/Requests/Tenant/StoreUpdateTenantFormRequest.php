<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string name
 * @property string domain
 * @property string db_database
 * @property string db_hostname
 * @property string db_username
 * @property string db_password
 * @property bool create_database
 */
class StoreUpdateTenantFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->id;

        return [
            'name' => 'required|min:3|max:100',
            'domain' => "required|min:3|max:191|unique:tenants,domain,{$id}",
            'db_database' => "required|min:3|max:191|unique:tenants,db_database,{$id}",
            'db_hostname' => 'required|min:3|max:100',
            'db_username' => 'required|min:3|max:100',
            'db_password' => 'required|min:3|max:35'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome da empresa é obrigatório.',
            'name.min' => 'Nome da empresa tem que ter pelo menos 3 caracteres.',
            'name.max' => 'Nome da empresa pode ter no máximo 100 caracteres.',

            'domain.required' => 'Nome do domínio é obrigatório.',
            'domain.min' => 'Nome do domínio tem que ter pelo menos 3 caracteres.',
            'domain.max' => 'Nome do domínio pode ter no máximo 191 caracteres.',
            'domain.unique' => 'Nome do domínio já existe no sistema, informe outro.',

            'db_database.required' => 'Nome do banco de dados é obrigatório.',
            'db_database.min' => 'Nome do banco de dados tem que ter pelo menos 3 caracteres.',
            'db_database.max' => 'Nome do banco de dados pode ter no máximo 191 caracteres.',
            'db_database.unique' => 'Nome do banco de dados já existe no sistema, informe outro.',

            'db_hostname.required' => 'Nome do hostname é obrigatório.',
            'db_hostname.min' => 'Nome do hostname tem que ter pelo menos 3 caracteres.',
            'db_hostname.max' => 'Nome do hostname pode ter no máximo 100 caracteres.',

            'db_username.required' => 'Nome do usuário é obrigatório.',
            'db_username.min' => 'Nome do usuário tem que ter pelo menos 3 caracteres.',
            'db_username.max' => 'Nome do usuário pode ter no máximo 100 caracteres.',

            'db_password.required' => 'Senha é obrigatório.',
            'db_password.min' => 'Senha tem que ter pelo menos 3 caracteres.',
            'db_password.max' => 'Senha pode ter no máximo 35 caracteres.',
        ];
    }
}
