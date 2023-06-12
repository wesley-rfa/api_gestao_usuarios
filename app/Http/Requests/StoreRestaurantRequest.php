<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreRestaurantRequest extends FormRequest
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
                'nome' => 'required|string',
                'nomeRestaurante' => 'required|string',
                'horaAbertura' => 'required|date_format:H:i:s',
                'horaFechamento' => 'required|date_format:H:i:s',
                'descricao' => 'required|string',
                'telefone' => 'required|string',
                'email' => 'required|email',
                'senha' => 'required|string',
                'imagem' => 'required|string',
                'cep' => 'required|string',
                'rua' => 'required|string',
                'numero' => 'required|integer',
                'complemento' => 'string',
                'pontoReferencia' => 'string',
                'estado' => 'required|string',
                'cidade' => 'required|string',
                'especialidade' => 'required|string',
            ];
        }
    }
