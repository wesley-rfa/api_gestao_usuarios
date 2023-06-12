<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Repositories\PedidoRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class PedidoController extends Controller
{
    private $pedidoRepository;

    public function __construct()
    {
        $this->pedidoRepository = new PedidoRepository();
        parent::__construct($this->pedidoRepository, Pedido::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->pedidoRepository->create($request->validated());
        return responseEnveloper('Orders', $result, [], true, null, null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $result = $this->pedidoRepository->update($request->validated(), $id);
        return responseEnveloper('Orders', $result, [], true, null, null);
    }
}
