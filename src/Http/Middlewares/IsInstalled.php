<?php

namespace Lara\Installer\Http\Middlewares;

use Closure;

class IsInstalled
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
        $isAppInstalled = config('installer.verify.installed');
        if (!$isAppInstalled) {
            return $next($request);
        } 
        return redirect(url('/'));
    }
}
