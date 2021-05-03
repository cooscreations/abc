<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFabricRequest;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Models\Fabric;
use App\Models\FabricGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fabric_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabrics = Fabric::with(['fabric_group'])->get();

        $fabric_groups = FabricGroup::get();

        return view('frontend.fabrics.index', compact('fabrics', 'fabric_groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric_groups = FabricGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.fabrics.create', compact('fabric_groups'));
    }

    public function store(StoreFabricRequest $request)
    {
        $fabric = Fabric::create($request->all());

        return redirect()->route('frontend.fabrics.index');
    }

    public function edit(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric_groups = FabricGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabric->load('fabric_group');

        return view('frontend.fabrics.edit', compact('fabric_groups', 'fabric'));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $fabric->update($request->all());

        return redirect()->route('frontend.fabrics.index');
    }

    public function show(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric->load('fabric_group', 'fabricFabricNicknames');

        return view('frontend.fabrics.show', compact('fabric'));
    }

    public function destroy(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric->delete();

        return back();
    }

    public function massDestroy(MassDestroyFabricRequest $request)
    {
        Fabric::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
