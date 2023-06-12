<?php

namespace App\Http\Controllers;

use App\Repositories\EnderecoRepository;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\EnderecoCliente;

class EnderecoController extends Controller
{
    private $enderecoRepository;

    public function __construct()
    {
        $this->enderecoRepository = new EnderecoRepository();
        parent::__construct($this->enderecoRepository, EnderecoCliente::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $result = $this->enderecoRepository->create($request->validated());
        return responseEnveloper('Address', $result, [], true, null, null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $result = $this->enderecoRepository->update($request->validated(), $id);
        return responseEnveloper('Address', $result, [], true, null, null);
    }
}
