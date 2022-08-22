<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest; 

use Illuminate\Auth\AuthenticationException; 
use Illuminate\Support\Facades\Auth; 
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful; 

class AuthLoginApiController extends Controller
{
    //! CREDIT : https://www.youtube.com/watch?v=FpwOvxsG8Js

    /**
     * Authenticate User 
     * 
     * @param AuthLoginRequest $request 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AuthLoginRequest $request) : \Illuminate\Http\JsonResponse
    {
        /**
         * For Front-End Frameworks e.g. Nuxt & Redux
         */
        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) 
        {
            $this->authenticateFrontend();
        }
        /**
         * For API Tokens and API Clients  
         */
        else 
        {
            $this->authenticateToken(request()); 

            $token = $request->user()->createToken('sanctum');

            return response()->json(
                data : 
                [
                    'message' => 'LIST OF HOTELS',
                    'data'    => 
                    [
                        "token" => $token->plainTextToken,
                    ]
                ]
            ); 
        }
    }

    /**
     * Authenticate if Frontend 
     * 
     * @return void 
     */
    private function authenticateFrontend() : void 
    {
        if (
            !Auth::guard('web')
                ->attempt(
                    request()->only('email', 'password'),
                )
        ) 
        {
            throw new AuthenticationException();;
        }
    }    
    
    /**
     * Authenticate Token
     * 
     * @return void 
     */
    private function authenticateToken() : void
    {
        Auth::attempt(request()->only('email', 'password'));
    }
}