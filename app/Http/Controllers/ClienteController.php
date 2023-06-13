<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    private $clienteRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
        parent::__construct($this->clienteRepository, Cliente::class);
    }

    public function store(StoreUserRequest $request)
    {
        $newClient = $request->validated();
        return responseEnveloper('Clients', Cliente::create($newClient), [], true, null, null);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $client = User::findOrfail($id);
        $client->update($request->validated());
        return responseEnveloper('Clients', $client, [], true, null, null);
    }

    public function login(Request $request)
    {
        $result = $this->clienteRepository->login($request);
        if (empty($result)) {
            return responseEnveloper('Clients', $result, [], false, null, null);
        }
        return responseEnveloper('Clients', $result, [], true, null, null);
    }
}
