<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLogin
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
         // cek apakah di auth ada data login kala ada boleh akses 
         if (Auth::check()){
            return $next($request);
        }
        //kalau ga ada data orang login diarahin ke halaman depan 
        return redirect('/')->with('gagal', 'Silahkan Login Terlebih Dahulu');
    }
       
}
