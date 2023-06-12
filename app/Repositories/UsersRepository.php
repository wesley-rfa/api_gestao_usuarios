<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        return User::with('enderecos')->get();
    }
}
