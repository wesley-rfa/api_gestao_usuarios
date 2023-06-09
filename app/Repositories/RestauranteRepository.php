<?php

namespace App\Repositories;

use App\Models\Restaurante;

class RestauranteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Restaurante());
    }
}
