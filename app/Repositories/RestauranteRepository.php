<?php

namespace App\Repositories;

use App\Models\Restaurante;

class RestauranteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Restaurante());
    }

    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        return Restaurante::with('pratos')->get();
    }

    public function login($request) {
        return Restaurante::where('nome', $request['nome'])->where('senha', $request['senha'])->first(); 
    }
}
