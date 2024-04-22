<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Rank;
use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (! $user) {
            return $next($request);
        }

        $userRoles = $user->roles->pluck('id')->toArray();
        $userRanks = $user->rank()->pluck('id')->toArray();
        $userPermissions = [];

        foreach ($userRoles as $userRole) {
            $permissions = Role::find($userRole)->permissions;
            foreach ($permissions as $permission) {
                $userPermissions[$permission->title] = $permission->id;
            }
        }

        foreach ($userRanks as $userRank) {
            $permissions = Rank::find($userRank)->permissions;
            foreach ($permissions as $permission) {
                $userPermissions[$permission->title] = $permission->id;
            }
        }

        $permissionsArray = Permission::pluck('id', 'title')->toArray();
        foreach ($permissionsArray as $title => $id) {
            Gate::define($title, function ($user) use ($userPermissions, $permissionsArray) {
                return count(array_intersect($userPermissions, $permissionsArray)) > 0;
            });
        }

        return $next($request);
    }
}
