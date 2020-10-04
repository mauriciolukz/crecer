<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Closure;

class master
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    Protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth=$auth;
    }

    public function handle($request, Closure $next)
    {   
        switch($this->auth->user()->rol)
        {
            case '1':
                    //return redirect()->to('master');
                    break;
            case '2':
                    return redirect()->to('asociado');
                    break;          
            default:
                    return redirect()->to('login');
                    break;            

        }
        return $next($request);
    }
}
