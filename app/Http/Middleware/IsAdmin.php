<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check())
        {
            return response()->json([
                'message'=>'Unauthorized',
                'error'=>'User is not authenticated'
            ], 401);
        }

        $user = Auth::user();

        if($user->hasRole('admin')){
            return $next($request);
        }

        return response()->json([
            'message'=>'Forbidden',
            'error'=>'User does not have the require role'
        ], 403);
    }
}
