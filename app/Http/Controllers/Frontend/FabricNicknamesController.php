<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFabricNicknameRequest;
use App\Http\Requests\StoreFabricNicknameRequest;
use App\Http\Requests\UpdateFabricNicknameRequest;
use App\Models\ContactCompany;
use App\Models\Fabric;
use App\Models\FabricNickname;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricNicknamesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fabric_nickname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricNicknames = FabricNickname::with(['fabric', 'customer'])->get();

        return view('frontend.fabricNicknames.index', compact('fabricNicknames'));
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_nickname_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabrics = Fabric::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.fabricNicknames.create', compact('fabrics', 'customers'));
    }

    public function store(StoreFabricNicknameRequest $request)
    {
        $fabricNickname = FabricNickname::create($request->all());

        return redirect()->route('frontend.fabric-nicknames.index');
    }

    public function edit(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabrics = Fabric::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabricNickname->load('fabric', 'customer');

        return view('frontend.fabricNicknames.edit', compact('fabrics', 'customers', 'fabricNickname'));
    }

    public function update(UpdateFabricNicknameRequest $request, FabricNickname $fabricNickname)
    {
        $fabricNickname->update($request->all());

        return redirect()->route('frontend.fabric-nicknames.index');
    }

    public function show(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricNickname->load('fabric', 'customer');

        return view('frontend.fabricNicknames.show', compact('fabricNickname'));
    }

    public function destroy(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricNickname->delete();

        return back();
    }

    public function massDestroy(MassDestroyFabricNicknameRequest $request)
    {
        FabricNickname::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
