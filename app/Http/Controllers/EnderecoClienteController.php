<?php

namespace App\Http\Controllers;

use App\Models\EnderecoCliente;
use Illuminate\Http\Request;
use App\Repositories\EnderecoClienteRepository;

class EnderecoClienteController extends Controller
{
    private $enderecoClienteRepository;
    
    public function __construct()
    {
        $this->enderecoClienteRepository = new EnderecoClienteRepository();
        parent::__construct($this->enderecoClienteRepository, EnderecoCliente::class);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnderecoCliente  $enderecoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnderecoCliente $enderecoCliente)
    {
        //
    }
}
