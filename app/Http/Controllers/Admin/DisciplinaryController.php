<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDisciplinaryRequest;
use App\Http\Requests\StoreDisciplinaryRequest;
use App\Http\Requests\UpdateDisciplinaryRequest;
use App\Models\Disciplinary;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DisciplinaryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('disciplinary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinaries = Disciplinary::with(['officer', 'issued_by'])->get();

        $pageName = 'disciplinary';
        $crudName = 'admin.disciplinaries.';
        $gateName = 'disciplinary_';
        return view('admin.disciplinaries.index', compact('disciplinaries', 'pageName', 'crudName', 'gateName'));
    }

    public function create()
    {
        abort_if(Gate::denies('disciplinary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.disciplinaries.create', compact('issued_bies', 'officers'));
    }

    public function store(StoreDisciplinaryRequest $request)
    {
        $disciplinary = Disciplinary::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $disciplinary->id]);
        }

        return redirect()->route('admin.disciplinaries.index');
    }

    public function edit(Disciplinary $disciplinary)
    {
        abort_if(Gate::denies('disciplinary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issued_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disciplinary->load('officer', 'issued_by');

        return view('admin.disciplinaries.edit', compact('disciplinary', 'issued_bies', 'officers'));
    }

    public function update(UpdateDisciplinaryRequest $request, Disciplinary $disciplinary)
    {
        $disciplinary->update($request->all());

        return redirect()->route('admin.disciplinaries.index');
    }

    public function show(Disciplinary $disciplinary)
    {
        abort_if(Gate::denies('disciplinary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinary->load('officer', 'issued_by');

        return view('admin.disciplinaries.show', compact('disciplinary'));
    }

    public function destroy(Disciplinary $disciplinary)
    {
        abort_if(Gate::denies('disciplinary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinary->delete();

        return back();
    }

    public function massDestroy(MassDestroyDisciplinaryRequest $request)
    {
        $disciplinaries = Disciplinary::find(request('ids'));

        foreach ($disciplinaries as $disciplinary) {
            $disciplinary->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('disciplinary_create') && Gate::denies('disciplinary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Disciplinary();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
