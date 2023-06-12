<?php

namespace App\Repositories;

use App\Models\Restaurante;

class RestauranteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Restaurante());
    }

    public function login($request) { 
        return Restaurante::where('nome', $request['nome'])->where('senha', bcrypt($request['senha']))->get()->toArray(); 
    }
}
