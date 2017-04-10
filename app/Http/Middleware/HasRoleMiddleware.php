<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use URL;
use App;

class HasRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        // dd($roles);
        $roles = explode('_',$roles);
        foreach($roles as $role)
            if($request->user()->role->name === $role)
                return $next($request);

        Session::flash('alert-danger','You do not have the permissions needed to perform that action.');
        // $request->flash();
        // return redirect('/');
        return redirect(URL::previous())->withInput($request->all());
    }
}
