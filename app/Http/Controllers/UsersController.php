<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrfail($id);
        $user->update($request->validated());
        return $user;
    }

    public function show(Request $request, $id)
    {
        dd("show");
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->destroy($id);
        return $user;
    }
}
