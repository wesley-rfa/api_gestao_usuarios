<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(StoreUserRequest $request)
    {
        $newUser = $request->validated();
        $newUser['password'] = bcrypt($newUser['password']);
        return User::create($newUser);
    }

    public function update(Request $request, $id)
    {
        dd("update");
    }

    public function show(Request $request, $id)
    {
        dd("show");
    }

    public function destroy(Request $request, $id)
    {
        return User::destroy($id);
    }
}
