<?php

namespace App\Http\Middleware\Login\User;

use Closure;
use Illuminate\Support\Facades\Config;

class UserMiddleware
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
            if ($request->session()->get('roleId') == 3) {
                $getDatBasename = $request->session()->get('databasename');
            Config::set('database.connections.dynamicsql.database', $getDatBasename);
            Config::set('database.default', 'dynamicsql');
            return $next($request);
            } else {
                return redirect('/');
            }


        }
    }
}
