<?php

namespace App\Repositories;

use App\Models\PedidoItem;

class PedidoItemRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new PedidoItem());
    }
}
