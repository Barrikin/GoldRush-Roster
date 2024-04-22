<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDisciplinaryRequest;
use App\Http\Requests\UpdateDisciplinaryRequest;
use App\Http\Resources\Admin\DisciplinaryResource;
use App\Models\Disciplinary;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisciplinaryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('disciplinary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisciplinaryResource(Disciplinary::with(['officer', 'issued_by'])->get());
    }

    public function store(StoreDisciplinaryRequest $request)
    {
        $disciplinary = Disciplinary::create($request->all());

        return (new DisciplinaryResource($disciplinary))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Disciplinary $disciplinary)
    {
        abort_if(Gate::denies('disciplinary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisciplinaryResource($disciplinary->load(['officer', 'issued_by']));
    }

    public function update(UpdateDisciplinaryRequest $request, Disciplinary $disciplinary)
    {
        $disciplinary->update($request->all());

        return (new DisciplinaryResource($disciplinary))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Disciplinary $disciplinary)
    {
        abort_if(Gate::denies('disciplinary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplinary->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
