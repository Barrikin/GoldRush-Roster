<?php

namespace App\Http\Middleware;

use App\Models\Certification;
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
        $userCertifications = $user->certifications()->pluck('id')->toArray();
        $userPermissions = [];

        foreach ($userRoles as $userRole) {
            $permissions = Role::find($userRole)->permissions;
            foreach ($permissions as $permission) {
                $userPermissions[] = $permission->title;
            }
        }

        foreach ($userRanks as $userRank) {
            $permissions = Rank::find($userRank)->permissions;
            foreach ($permissions as $permission) {
                $userPermissions[] = $permission->title;
            }
        }

        foreach ($userCertifications as $userCertification) {
            $permissions = Certification::find($userCertification)->permissions;
            foreach ($permissions as $permission) {
                $userPermissions[] = $permission->title;
            }
        }

        $permissionsArray = Permission::pluck('id', 'title')->toArray();
        foreach ($permissionsArray as $title => $id) {
            Gate::define($title, function ($user) use ($userPermissions, $title) {
                if ($user->is_admin) { return true; }
                return in_array($title, $userPermissions);
            });
        }

        return $next($request);
    }
}
