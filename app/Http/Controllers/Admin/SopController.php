<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySopRequest;
use App\Http\Requests\StoreSopRequest;
use App\Http\Requests\UpdateSopRequest;
use App\Models\Role;
use App\Models\Sop;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SopController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Gate::allows('trash.view')) {
            $sops = Sop::withTrashed()->with(['ranks'])->get();
        }
        else {
            $sops = Sop::with(['ranks'])->get();
        }


        $pageName = 'sop';
        $crudName = 'admin.sops.';
        $gateName = 'sop_';
        return view('admin.sops.index', compact('sops', 'pageName', 'crudName', 'gateName'));
    }

    public function create()
    {
        abort_if(Gate::denies('sop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ranks = Role::pluck('title', 'id');

        return view('admin.sops.create', compact('ranks'));
    }

    public function store(StoreSopRequest $request)
    {
        $sop = Sop::create($request->all());
        $sop->ranks()->sync($request->input('ranks', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sop->id]);
        }

        return redirect()->route('admin.sops.index');
    }

    public function edit(Sop $sop)
    {
        abort_if(Gate::denies('sop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ranks = Role::pluck('title', 'id');

        $sop->load('ranks');

        return view('admin.sops.edit', compact('ranks', 'sop'));
    }

    public function update(UpdateSopRequest $request, Sop $sop)
    {
        $sop->update($request->all());
        $sop->ranks()->sync($request->input('ranks', []));

        return redirect()->route('admin.sops.index');
    }

    public function show(Sop $sop)
    {
        abort_if(Gate::denies('sop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sop->load('ranks');

        return view('admin.sops.show', compact('sop'));
    }

    public function destroy(Sop $sop)
    {
        abort_if(Gate::denies('sop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sop->delete();

        return back();
    }

    public function massDestroy(MassDestroySopRequest $request)
    {
        $sops = Sop::find(request('ids'));

        foreach ($sops as $sop) {
            $sop->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function restore(Request $request) {
        Sop::withTrashed()->findOrFail($request->post()['sop_id'])->restore();

        return redirect()->route('admin.sops.index');
    }

    public function forceDestroy(Request $request) {
        Sop::withTrashed()->findOrFail($request->post()['sop_id'])->forceDelete();

        return redirect()->route('admin.sops.index');
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sop_create') && Gate::denies('sop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sop();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
