<?php

namespace Manindersandhu\Installer\Http\Middlewares;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaraSidebar\LaravelSidebar\Http\Models\Sidebar;
use LaraSidebar\LaravelSidebar\Http\Models\SidebarAccess;


class IsAdmin
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
        // Check if the application is installed
        $isAppInstalled = config('installer.verify.installed');
        if (!$isAppInstalled) {
            return redirect(url('/'));
        }
        $currentUrl = $request->path();
        if (str_contains($currentUrl, 'adman')) {

            if (!Auth::check()) {
                return redirect()->route('login');
            }
            $slug = preg_replace('/^admin\/?/', '', $currentUrl);
            $userRoleId = Auth::user()->role_id;

            if (!$this->userHasAccess($userRoleId, $slug)) {
                return redirect('/');
            }
        }

        return $next($request);
    }

    /**
     * Check if the user has access to the current route.
     *
     * @param  int  $role_id
     * @param  string  $slug
     * @return bool
     */
    private function userHasAccess($role_id, $slug)
    {
        return SidebarAccess::with(['sidebar' => function ($query) use ($slug) {
            $query->where('url', $slug);
        }])->where('role_id', $role_id)
            ->where('access', true)
            ->exists();
    }
}
