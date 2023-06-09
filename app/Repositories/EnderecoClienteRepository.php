<?php

namespace App\Repositories;

use App\Models\EnderecoCliente;

class EnderecoClienteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new EnderecoCliente());
    }
}
