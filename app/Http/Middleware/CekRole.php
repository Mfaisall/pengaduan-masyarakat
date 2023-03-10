<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CekRole
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

        // ...$roles akan meubah strin gyang dipisah dengan koma menjadi item array nama nya spread oprator 
        // $request ->user()->role akan ambil data user yang login 
        // in array untuk mengecek data dalam array user role nya ada apa tidak 
        // request role mengabil data orang yang login 
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        return redirect()->back();
    }
}



// public function handle($request, Closure $next)
// {
//     //jika akun yang login sesuai dengan role 
//     //maka silahkan akses
//     //jika tidak sesuai akan diarahkan ke home

//     $roles = array_slice(func_get_args(), 2);

//     foreach ($roles as $role) { 
//         $user = \Auth::user()->role;
//         if( $user == $role){
//             return $next($request);
//         }
//     }

//     return redirect('/');
// }
