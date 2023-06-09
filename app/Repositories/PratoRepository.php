<?php

namespace App\Repositories;

use App\Models\Prato;

class PratoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Prato());
    }
}
