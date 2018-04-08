<?php

namespace App\Http\Middleware;

use Closure;

class IdentificacionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
        public function handle($request, Closure $next)
        {
            
            $url=$request->url();
            $partes=explode('/',$url);
           // dd($partes);
            if ($request->session()->has('id_usuario')) {
                return $next($request);    
            }
            return redirect('/');
            
        }
    
}
