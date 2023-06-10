<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UsersRepository;
class UsersController extends Controller
{
    private $usersRepository;
    
    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
        parent::__construct($this->usersRepository, User::class);
    }

    public function store(StoreUserRequest $request)
    {
        $newUser = $request->validated();
        $newUser['password'] = bcrypt($newUser['password']);
        return responseEnveloper('Users', User::create($newUser), [], true, null, null);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrfail($id);
        $user->update($request->validated());
        return responseEnveloper('Users', $user, [], true, null, null);
    }
}
