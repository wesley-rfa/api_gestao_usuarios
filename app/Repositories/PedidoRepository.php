<?php

namespace App\Repositories;

use App\Models\Pedido;

class PedidoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Pedido());
    }
}
