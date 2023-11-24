<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(!auth()->check() || auth()->user()->role == 'Administrator'){
            return $next($request);
        }elseif(!auth()->check() || auth()->user()->role == 'Staff'){
            return $next($request);
        }elseif(!auth()->check() || auth()->user()->role == 'Group Leader'){
            return $next($request);
        }elseif (!auth()->check() || auth()->user()->role == 'Manager') {
            return $next($request);
        }elseif (!auth()->check() || auth()->user()->role == 'Deputy General') {
            return $next($request);
        }elseif (!auth()->check() || auth()->user()->role == 'Division Head') {
            return $next($request);
        }
        else{
            // $request->session()->flash('error','You dont have access for this web');
            abort(403, 'Unauthorized action.');
        }
    }
}
