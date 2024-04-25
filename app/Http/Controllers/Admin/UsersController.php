<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Certification;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles', 'certifications', 'rank'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        $ranks = Rank::where('id', '>', Auth::id())->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('certifications', 'ranks', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->certifications()->sync($request->input('certifications', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        $ranks = Rank::where('id', '>', Auth::user()->rank_id)->pluck('title', 'id');

        $user->load('roles', 'certifications', 'rank');

        return view('admin.users.edit', compact('certifications', 'ranks', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($request->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->certifications()->sync($request->input('certifications', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'certifications', 'rank', 'officerDisciplinaries', 'officerComments', 'officerTrainings', 'officerSopSignOffs', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
