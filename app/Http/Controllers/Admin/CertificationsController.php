<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCertificationRequest;
use App\Http\Requests\StoreCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;
use App\Models\Certification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('certification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certifications = Certification::all();

        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('certification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certifications.create');
    }

    public function store(StoreCertificationRequest $request)
    {
        $certification = Certification::create($request->all());

        return redirect()->route('admin.certifications.index');
    }

    public function edit(Certification $certification)
    {
        abort_if(Gate::denies('certification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(UpdateCertificationRequest $request, Certification $certification)
    {
        $certification->update($request->all());

        return redirect()->route('admin.certifications.index');
    }

    public function show(Certification $certification)
    {
        abort_if(Gate::denies('certification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certifications.show', compact('certification'));
    }

    public function destroy(Certification $certification)
    {
        abort_if(Gate::denies('certification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certification->delete();

        return back();
    }

    public function massDestroy(MassDestroyCertificationRequest $request)
    {
        $certifications = Certification::find(request('ids'));

        foreach ($certifications as $certification) {
            $certification->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
