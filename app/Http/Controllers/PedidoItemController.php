<?php

namespace App\Http\Controllers;

use App\Models\PedidoItem;
use Illuminate\Http\Request;
use App\Repositories\PedidoItemRepository;

class PedidoItemController extends Controller
{
    private $pedidoItemRepository;
    
    public function __construct()
    {
        $this->pedidoItemRepository = new PedidoItemRepository();
        parent::__construct($this->pedidoItemRepository, PedidoItem::class);
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
     * @param  \App\Models\PedidoItem  $pedidoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoItem $pedidoItem)
    {
        //
    }
}
