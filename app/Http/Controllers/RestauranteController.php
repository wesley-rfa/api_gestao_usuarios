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
        $newRestaurant = $request->validated(); 
        return responseEnveloper('Restaurantes', Restaurante::create($newRestaurant ), [], true, null, null); 
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
        $restaurant = Restaurante::findOrfail($id); $restaurant->update($request->validated()); 
        return responseEnveloper('Restaurantes', $restaurant, [], true, null, null); 
    }
}
