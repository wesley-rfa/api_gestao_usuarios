<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        dd("store");
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
