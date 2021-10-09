<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission=null)
    {
        if(!$request->user()->hasRole($role)) {

            return Redirect::back()->with('error','you lack role to perform the action');

        }

        if($permission !== null && !$request->user()->can($permission)) {

            return Redirect::back()->with('error','you lack permission to perform the action');
        }

        return $next($request);
    }
}
