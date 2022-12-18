<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveSellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::guard('web')->check()){
        //     if(Auth::guard('web')->user()->is_active == true){
        //         return $next($request);
        //     }else{
        //         return back()->withErrors([
        //             'inactive' => 'User inactive',
        //         ]);
        //     }
        // }else{
        //     return redirect('/login');
        // }

        if(Auth::guard('web')->user()->status == 'active'){
            return $next($request);
        }else{
            $message = 'User '.Auth::guard('web')->user()->status.'. Please call support';
            Auth::guard('web')->logout();
            return redirect('/login')->with('error', $message)->onlyInput('email');
        }

    }
}
