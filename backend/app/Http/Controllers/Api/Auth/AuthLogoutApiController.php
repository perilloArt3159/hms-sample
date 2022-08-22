<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class AuthLogoutApiController extends Controller
{
    /**
     * Unauthenticate User 
     * 
     * @return \Illuminate\Http\JsonResponse | void
     */
    public function __invoke(Request $request)
    {
        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) 
        {
            Auth::guard('web')->logout();

            request()->session()->invalidate();

            request()->session()->regenerateToken();
        } 
        else 
        {
            $request->user()->currentAccessToken()->delete();

            return response()->json(
                data : 
                [
                    'message' => 'TOKEN REVOKED',
                    'data'    =>  null 
                ]
            ); 
        }
    }
}
