<?php

namespace App\Http\Middleware;

use App\Models\Certification;
use App\Models\Permission;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Auth\Access\Response;
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
            Gate::define($title, function (User $user, $target = null) use ($userPermissions, $title) {
                if ($target?->rank?->rank_order) {
                    if ($user->rank->rank_order >= $target->rank->rank_order) {
                        return Response::deny('You can not edit this user.');
                    }
                }
                return in_array($title, $userPermissions);
            });
        }

        Gate::before(function (User $user, string $ability) use ($userPermissions) {
           if ($user->isAdministrator() || in_array('administrator', $userPermissions)) { return true; }
        });

        return $next($request);
    }
}
