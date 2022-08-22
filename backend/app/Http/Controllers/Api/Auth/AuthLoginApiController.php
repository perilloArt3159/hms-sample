<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest; 

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthLoginApiController extends Controller
{
    /**
     * Authenticate User 
     * 
     * @param AuthLoginRequest $request 
     * 
     * @return void 
     */
    public function __invoke(AuthLoginRequest $request):void 
    {
        if (!auth()->attempt($request->only('email', 'password')))
        {
            throw new AuthenticationException();
        }
    }
}
    