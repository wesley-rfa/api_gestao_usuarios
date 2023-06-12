<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Repositories\RestauranteRepository;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;

class RestauranteController extends Controller
{
    private $restauranteRepository;

    public function __construct()
    {
        $this->restauranteRepository = new RestauranteRepository();
        parent::__construct($this->restauranteRepository, Restaurante::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        $request['senha'] = bcrypt($request['senha']);
        $result = $this->restauranteRepository->create($request->validated());
        return responseEnveloper('Restaurants', $result, [], true, null, null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        $restaurant = Restaurante::findOrfail($id);
        if (isset($request->validated()['senha'])) $request->validated()['senha'] = bcrypt($request->validated()['senha']);
        $restaurant->update($request->validated());
        return responseEnveloper('Restaurants', $restaurant, [], true, null, null);
    }

    public function login(Request $request)
    {
        $result = $this->restauranteRepository->login($request);
        if (empty($result)) {
            return responseEnveloper('Restaurant', $result, [], false, null, null);
        }
        return responseEnveloper('Restaurant', $result, [], true, null, null);
    }
}
