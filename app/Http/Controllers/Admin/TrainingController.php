<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrainingRequest;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Models\Course;
use App\Models\Training;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TrainingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('training_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Gate::allows('trash.view')) {
            $trainings = Training::withTrashed()->with(['officer', 'course', 'understood_fto', 'executed_fto'])->get();
        }
        else {
            $trainings = Training::with(['officer', 'course', 'understood_fto', 'executed_fto'])->get();
        }


        $pageName = 'training';
        $crudName = 'admin.trainings.';
        $gateName = 'training_';
        return view('admin.trainings.index', compact('trainings', 'pageName', 'crudName', 'gateName'));
    }

    public function create()
    {
        abort_if(Gate::denies('training_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $understood_ftos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $executed_ftos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainings.create', compact('courses', 'executed_ftos', 'officers', 'understood_ftos'));
    }

    public function store(StoreTrainingRequest $request)
    {
        $training = Training::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $training->id]);
        }

        return redirect()->route('admin.trainings.index');
    }

    public function edit(Training $training)
    {
        abort_if(Gate::denies('training_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $officers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $understood_ftos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $executed_ftos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $training->load('officer', 'course', 'understood_fto', 'executed_fto');

        return view('admin.trainings.edit', compact('courses', 'executed_ftos', 'officers', 'training', 'understood_ftos'));
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $training->update($request->all());

        return redirect()->route('admin.trainings.index');
    }

    public function show(Training $training)
    {
        abort_if(Gate::denies('training_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training->load('officer', 'course', 'understood_fto', 'executed_fto');

        return view('admin.trainings.show', compact('training'));
    }

    public function destroy(Training $training)
    {
        abort_if(Gate::denies('training_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training->delete();

        return back();
    }

    public function restore(Request $request) {
        Training::withTrashed()->findOrFail($request->post()['training_id'])->restore();

        return redirect()->route('admin.trainings.index');
    }

    public function forceDestroy(Request $request) {
        Training::withTrashed()->findOrFail($request->post()['training_id'])->forceDelete();

        return redirect()->route('admin.trainings.index');
    }

    public function massDestroy(MassDestroyTrainingRequest $request)
    {
        $trainings = Training::find(request('ids'));

        foreach ($trainings as $training) {
            $training->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('training_create') && Gate::denies('training_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Training();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
