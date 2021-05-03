<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBaseStyleRequest;
use App\Http\Requests\StoreBaseStyleRequest;
use App\Http\Requests\UpdateBaseStyleRequest;
use App\Models\BaseStyle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseStylesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('base_style_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baseStyles = BaseStyle::all();

        return view('frontend.baseStyles.index', compact('baseStyles'));
    }

    public function create()
    {
        abort_if(Gate::denies('base_style_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.baseStyles.create');
    }

    public function store(StoreBaseStyleRequest $request)
    {
        $baseStyle = BaseStyle::create($request->all());

        return redirect()->route('frontend.base-styles.index');
    }

    public function edit(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.baseStyles.edit', compact('baseStyle'));
    }

    public function update(UpdateBaseStyleRequest $request, BaseStyle $baseStyle)
    {
        $baseStyle->update($request->all());

        return redirect()->route('frontend.base-styles.index');
    }

    public function show(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baseStyle->load('baseStyleBedSizesByRegions');

        return view('frontend.baseStyles.show', compact('baseStyle'));
    }

    public function destroy(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baseStyle->delete();

        return back();
    }

    public function massDestroy(MassDestroyBaseStyleRequest $request)
    {
        BaseStyle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
