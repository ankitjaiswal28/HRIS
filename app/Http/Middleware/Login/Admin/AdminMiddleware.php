<?php

namespace App\Http\Middleware\Login\Admin;

use Closure;

use Illuminate\Support\Facades\Config;

class AdminMiddleware
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
        if (!$request->session()->exists('roleId')) {
            return redirect('/');
        } else {
            // echo $request->session()->exists('roleId');
            // echo $sss = $request->session()->get('databasename');
            $getDatBasename = $request->session()->get('databasename');
            Config::set('database.connections.dynamicsql.database', $getDatBasename);
            Config::set('database.default', 'dynamicsql');
            return $next($request);
        }

        // return $next($request);
    }
}
