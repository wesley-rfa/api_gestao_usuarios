<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;
use App\Repositories\PratoRepository;

class PratoController extends Controller
{
    private $pratoRepository;
    
    public function __construct()
    {
        $this->pratoRepository = new PratoRepository();
        parent::__construct($this->pratoRepository, Prato::class);
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
     * @param  \App\Models\Prato  $prato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prato $prato)
    {
        //
    }
}
