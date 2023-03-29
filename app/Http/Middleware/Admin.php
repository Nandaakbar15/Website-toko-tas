<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Akses;

class Admin
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

        if(isset(auth()->user()->id)){
            $akses = Akses::getGrupUser(auth()->user()->id);
            foreach($akses as $p){
                $kelompok = $p->kelompok;
            }
        } else {
            return redirect('/');
        }

        if(!auth()->check() || $kelompok !== 'admin'){
            abort(404);
        }

        return $next($request);
    }
}
