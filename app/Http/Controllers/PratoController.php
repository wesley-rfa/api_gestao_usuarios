<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;
use App\Repositories\PratoRepository;
use App\Http\Requests\StoreDisheRequest;
use App\Http\Requests\UpdateDisheRequest;

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
    public function store(StoreDisheRequest $request)
    {
        $result = $this->pratoRepository->create($request->validated());
        return responseEnveloper('Dishes', $result, [], true, null, null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prato  $prato
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisheRequest $request, $id)
    {
        $result = $this->pratoRepository->update($request->validated(), $id);
        return responseEnveloper('Dishes', $result, [], true, null, null);
    }
}
