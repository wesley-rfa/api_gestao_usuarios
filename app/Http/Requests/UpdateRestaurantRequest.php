`<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequestextends FormRequest
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
        'nome' => 'string',
        'nome_restaurante' => 'string',
        'hora_abertura' => 'date_format:H:i:s',
        'hora_fechamento' => 'date_format:H:i:s',
        'descricao' => 'string',
        'telefone' => 'required',
        'email' => 'email',
        'senha' => 'string',
        'imagem' => 'string',
        'cep' => 'string',
        'rua' => 'string',
        'numero' => 'integer',
        'complemento' => 'string',
        'ponto_referencia' => 'string',
        'estado' => 'string',
        'cidade' => 'string',
        'especialidade' => 'string',
    ];
}
}
`