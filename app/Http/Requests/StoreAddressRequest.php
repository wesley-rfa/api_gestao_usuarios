<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "clienteId" => "required|integer",
            "cep" => "required|string",
            "rua" => "required|string",
            "numero" => "required|integer",
            "complemento" => "string",
            "pontoReferencia" => "string",
            "estado" => "required|string",
            "cidade" => "required|string",
            "nomeIdentificador" => "required|string",
        ];
    }
}
