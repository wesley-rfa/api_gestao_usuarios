<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

     /**
     * Unauthorized user error return
     *
     * @param [type] $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        abort(responseError($request, ['errorCode' => 1, 'errorMessage' => 'Unauthorized user', 'statusCode' => 401]));
    }
}
