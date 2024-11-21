<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Get user role
        $role = "";
        if (auth()->user()->user_role_id == 1) {
            $role = "developer";
        } elseif (auth()->user()->user_role_id == 2) {
            $role = "admin";
        } elseif (auth()->user()->user_role_id == 3) {
            $role = "client";
        }

        // Check route prefix and allow/deny access based on role
        // $prefix = $request->route()->getPrefix();

        // if (($role == "developer" && $prefix !== '/dev') ||
        //     ($role == "admin" && $prefix !== '/ad') ||
        //     ($role == "client" && $prefix !== '/cl')) {
        //     abort(403, 'Unauthorized access.');
        // }


        $targetPrefixes = [
            'developer' => '/dev',
            'admin' => '/ad',
            'client' => '/cl',
        ];

        $pathExtention = $request->path();
        $extention = pathinfo($pathExtention, PATHINFO_EXTENSION);
        if ($extention == 'js' || $extention == 'css') {
            return $next($request);
        } 

        // Check if current prefix matches role's target prefix
        $currentPrefix = $request->route()->getPrefix();

        $hrefPath = $request->path();

        if ($currentPrefix !== $targetPrefixes[$role]) {
            return redirect($targetPrefixes[$role]."/".$hrefPath);  // Redirect to the correct prefix route
        }

        return $next($request);
    }
}
