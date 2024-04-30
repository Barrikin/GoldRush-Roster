<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySopSignOffRequest;
use App\Http\Requests\StoreSopSignOffRequest;
use App\Http\Requests\UpdateSopSignOffRequest;
use App\Models\Sop;
use App\Models\SopSignOff;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SopSignOffsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sop_sign_off_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopSignOffs = SopSignOff::with(['officer', 'sop'])->get();

        $pageName = 'SopSignOff';
        $crudName = 'admin.sop-sign-offs.';
        $gateName = 'sop_sign_off_';
        return view('admin.sopSignOffs.index', compact('sopSignOffs', 'pageName', 'crudName', 'gateName'));
    }

    public function create()
    {
        abort_if(Gate::denies('sop_sign_off_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sops = Sop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sopSignOffs.create', compact('officers', 'sops'));
    }

    public function store(StoreSopSignOffRequest $request)
    {
        $sopSignOff = SopSignOff::create($request->all());

        return redirect()->route('admin.sop-sign-offs.index');
    }

    public function edit(SopSignOff $sopSignOff)
    {
        abort_if(Gate::denies('sop_sign_off_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sops = Sop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sopSignOff->load('officer', 'sop');

        return view('admin.sopSignOffs.edit', compact('officers', 'sopSignOff', 'sops'));
    }

    public function update(UpdateSopSignOffRequest $request, SopSignOff $sopSignOff)
    {
        $sopSignOff->update($request->all());

        return redirect()->route('admin.sop-sign-offs.index');
    }

    public function show(SopSignOff $sopSignOff)
    {
        abort_if(Gate::denies('sop_sign_off_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopSignOff->load('officer', 'sop');

        return view('admin.sopSignOffs.show', compact('sopSignOff'));
    }

    public function destroy(SopSignOff $sopSignOff)
    {
        abort_if(Gate::denies('sop_sign_off_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopSignOff->delete();

        return back();
    }

    public function massDestroy(MassDestroySopSignOffRequest $request)
    {
        $sopSignOffs = SopSignOff::find(request('ids'));

        foreach ($sopSignOffs as $sopSignOff) {
            $sopSignOff->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
