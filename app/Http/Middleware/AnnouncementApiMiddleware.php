<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AnnouncementApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated

        $tokenIsValid = Auth::guard('api')->check();

        if(!$tokenIsValid){

            if($request->route()->named('api.v1.announcements.index')){
                return $next($request);
            }

            if($request->route()->named('api.v1.announcements.show')){
                return $next($request);
            }

            return response()->json([
                'message' => 'Unauthenticated, pasando por announcementApiMiuddleware',
            ], 401);

        }else{
            return $next($request);
        }


    }
}
