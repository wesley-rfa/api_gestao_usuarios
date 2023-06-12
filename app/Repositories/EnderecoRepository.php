<?php

namespace App\Repositories;

use App\Models\EnderecoCliente;
use Illuminate\Support\Facades\DB;
use Exception;

class EnderecoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new EnderecoCliente());
    }

    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        return EnderecoCliente::with('cliente')->get();
    }

}
