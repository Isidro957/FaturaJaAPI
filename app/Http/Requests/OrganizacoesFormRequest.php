<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizacoesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'name_org' => ['required', 'string', 'max:255'],
          'nif_org'  => ['required','int', 'max:9', 'unique:organizacoes'],
          'logo_org' => ['string', 'max:255'],
          'telefone_org' => ['required', 'string', 'max:255'],
          'email_org' => ['required', 'string', 'email', 'max:255', 'unique:organizacoes'],
          'provincia_org'  => ['string'],
          'regime_org'  => ['string'],
          'descricao_org'  => ['string'],
          #'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        #  'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }
}
