<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRankRequest;
use App\Http\Requests\StoreRankRequest;
use App\Http\Requests\UpdateRankRequest;
use App\Models\Permission;
use App\Models\Rank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RankController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ranks = Rank::with(['permissions'])->get();

        return view('admin.ranks.index', compact('ranks'));
    }

    public function create()
    {
        abort_if(Gate::denies('rank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        return view('admin.ranks.create', compact('permissions'));
    }

    public function store(StoreRankRequest $request)
    {
        $rank = Rank::create($request->all());
        $rank->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.ranks.index');
    }

    public function edit(Rank $rank)
    {
        abort_if(Gate::denies('rank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        $rank->load('permissions');

        return view('admin.ranks.edit', compact('permissions', 'rank'));
    }

    public function update(UpdateRankRequest $request, Rank $rank)
    {
        $rank->update($request->all());
        $rank->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.ranks.index');
    }

    public function show(Rank $rank)
    {
        abort_if(Gate::denies('rank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rank->load('permissions');

        return view('admin.ranks.show', compact('rank'));
    }

    public function destroy(Rank $rank)
    {
        abort_if(Gate::denies('rank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rank->delete();

        return back();
    }

    public function massDestroy(MassDestroyRankRequest $request)
    {
        $ranks = Rank::find(request('ids'));

        foreach ($ranks as $rank) {
            $rank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
