<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new User());
    }
}