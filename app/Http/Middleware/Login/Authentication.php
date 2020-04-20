<?php

namespace App\Http\Middleware\Login;
// use Illuminate\Support\Facades\Session;
use Session;
use Illuminate\Support\Facades\Config;

use Closure;

class Authentication
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
        // $getDatBasename = $request->session()->get('databasename');
        // Config::set('database.connections.dynamicsql.database', $getDatBasename);
        // Config::set('database.default', 'dynamicsql');
        // echo $request->session()->exists('roleId');
        if (!$request->session()->exists('roleId')) {
            return redirect('/');
        }
        return $next($request);
    }
}
