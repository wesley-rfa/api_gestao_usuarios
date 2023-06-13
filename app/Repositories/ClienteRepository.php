<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new Cliente());
    }

    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        return Cliente::with('enderecos')->get();
    }

    public function login($request) {
        return Cliente::where('name', $request['name'])->where('password', $request['password'])->first(); 
    }
}
