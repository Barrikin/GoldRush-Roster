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
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->trashed == 'true') {
            $users = User::onlyTrashed()->with(['roles', 'certifications', 'rank'])->get();
        }
        else {
            $users = User::with(['roles', 'certifications', 'rank'])->get();
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        if (Auth::user()->isAdmin()) {
            $ranks = Rank::orderBy('rank_order')->pluck('title', 'id');
        }
        else {
            $ranks = Rank::where('id', '>', Auth::user()->rank_id)->orderBy('rank_order')->pluck('title', 'id');
        }

        return view('admin.users.create', compact('certifications', 'ranks', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        if ($request->hired_on == '') { $input['hired_on'] = Carbon::now()->format('Y-m-d'); }
        $input['password'] = $request->phone_number;
        $input['change_password'] = true;
        $user = User::create($input);
        $user->roles()->sync($request->input('roles', []));
        $user->certifications()->sync($request->input('certifications', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (! Auth::user()->isAdmin()) {
            abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        if (Auth::user()->isAdmin()) {
            $ranks = Rank::orderBy('rank_order')->pluck('title', 'id');
        }
        else {
            $ranks = Rank::where('id', '>', Auth::user()->rank_id)->orderBy('rank_order')->pluck('title', 'id');
        }


        $user->load('roles', 'certifications', 'rank');

        return view('admin.users.edit', compact('certifications', 'ranks', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (! Auth::user()->isAdmin()) {
            abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
            abort_if($request->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

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

    public function destroy(Request $request, User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (! Auth::user()->isAdmin()) {
            abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        if ($request->force_delete) {
            $user->forceDelete();
        }
        else if ($request->restore) {
            $user->forceDelete();
        }
        else {
            $user->delete();
        }

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            if (! Auth::user()->isAdmin()) {
                abort_if($user->rank_id <= Auth::user()->rank_id, Response::HTTP_FORBIDDEN, '403 Forbidden');
            }
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
