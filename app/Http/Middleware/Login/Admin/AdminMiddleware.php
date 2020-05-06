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
            // echo $request->session()->get('roleId');
            if ($request->session()->get('roleId') == 2) {
                $getDatBasename = $request->session()->get('databasename');
            Config::set('database.connections.dynamicsql.database', $getDatBasename);
            Config::set('database.default', 'dynamicsql');
            return $next($request);
            } else {
                return redirect('/');
            }


        }

        // return $next($request);
    }
}
