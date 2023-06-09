<?php

namespace App\Repositories;

use App\Models\Prato;
use Illuminate\Support\Facades\DB;
use Exception;

class PratoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Prato());
    }

    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        return Prato::with('restaurante')->get();
    }
}
