<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Certification;
use App\Models\Comment;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $crudName = 'admin.users.';
        $gateName = 'user_';
        return view('admin.users.index', compact('users', 'crudName', 'gateName'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        if (Auth::user()->isAdministrator()) {
            $ranks = Rank::orderBy('rank_order')->pluck('title', 'id');
        }
        else {
            $ranks = Rank::where('rank_order', '>', Auth::user()->rank->rank_order)->orderBy('rank_order')->pluck('title', 'id');
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

        if (! Auth::user()->isAdministrator()) {
            abort_if(Auth::user()->rank->rank_order >= $user->rank->rank_order, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $roles = Role::pluck('title', 'id');

        $certifications = Certification::pluck('name', 'id');

        if (Auth::user()->isAdministrator()) {
            $ranks = Rank::orderBy('rank_order')->pluck('title', 'id');
        }
        else {
            $ranks = Rank::where('rank_order', '>', Auth::user()->rank->rank_order)->orderBy('rank_order')->pluck('title', 'id');
        }

        $user->load('roles', 'certifications', 'rank');

        return view('admin.users.edit', compact('certifications', 'ranks', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (! Auth::user()->isAdministrator()) {
            abort_if(Auth::user()->rank->rank_order >= $user->rank->rank_order, Response::HTTP_FORBIDDEN, '403 Forbidden');
            abort_if(Auth::user()->rank->rank_order >= $request->rank->rank_order, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        if ($request->password != '') { $request->change_password = true; }

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

        if (! Auth::user()->isAdministrator()) {
            abort_if(Auth::user()->rank->rank_order >= $user->rank->rank_order, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        if ($request->delete_type == 'resignation') {
            $user->update([
                'call_sign' => 'DELETED-' . Str::uuid(),
                'badge'     => 'DELETED-' . Str::uuid(),
                'status'    => 4,
                'password'  => Str::uuid(),
            ]);
            Comment::create([
                'officer_id'    => $user->id,
                'author_id'     => Auth::user()->id,
                'comment'       => 'Resigned: ' . $request->delete_reason,
            ]);
        }
        elseif ($request->delete_type == 'termination') {
            $user->update([
                'call_sign' => 'DELETED-' . Str::uuid(),
                'badge'     => 'DELETED-' . Str::uuid(),
                'status'    => 5,
                'password'  => Str::uuid(),
            ]);
            Comment::create([
                'officer_id'    => $user->id,
                'author_id'     => Auth::user()->id,
                'comment'       => 'Terminated: ' . $request->delete_reason,
            ]);
        }
        else {

        }

        $user->delete();

        return back();
    }

    public function restore(Request $request) {
        User::withTrashed()->findOrFail($request->post()['user_id'])->restore();

        return redirect()->route('admin.users.index');
    }

    public function forceDestroy(Request $request) {
        User::withTrashed()->findOrFail($request->post()['user_id'])->forceDelete();

        return redirect()->route('admin.users.index');
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            if (! Auth::user()->isAdministrator()) {
                abort_if(Auth::user()->rank->rank_order >= $user->rank->rank_order, Response::HTTP_FORBIDDEN, '403 Forbidden');
            }

            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
