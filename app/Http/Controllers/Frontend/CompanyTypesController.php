<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyTypeRequest;
use App\Http\Requests\StoreCompanyTypeRequest;
use App\Http\Requests\UpdateCompanyTypeRequest;
use App\Models\CompanyType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompanyTypesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('company_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyTypes = CompanyType::all();

        return view('frontend.companyTypes.index', compact('companyTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.companyTypes.create');
    }

    public function store(StoreCompanyTypeRequest $request)
    {
        $companyType = CompanyType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $companyType->id]);
        }

        return redirect()->route('frontend.company-types.index');
    }

    public function edit(CompanyType $companyType)
    {
        abort_if(Gate::denies('company_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.companyTypes.edit', compact('companyType'));
    }

    public function update(UpdateCompanyTypeRequest $request, CompanyType $companyType)
    {
        $companyType->update($request->all());

        return redirect()->route('frontend.company-types.index');
    }

    public function show(CompanyType $companyType)
    {
        abort_if(Gate::denies('company_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyType->load('primaryCompanyTypeContactCompanies');

        return view('frontend.companyTypes.show', compact('companyType'));
    }

    public function destroy(CompanyType $companyType)
    {
        abort_if(Gate::denies('company_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyType->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyTypeRequest $request)
    {
        CompanyType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('company_type_create') && Gate::denies('company_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CompanyType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
