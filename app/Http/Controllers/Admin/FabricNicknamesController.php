<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FabricNicknamesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fabric_nickname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FabricNickname::with(['fabric', 'customer'])->select(sprintf('%s.*', (new FabricNickname())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fabric_nickname_show';
                $editGate = 'fabric_nickname_edit';
                $deleteGate = 'fabric_nickname_delete';
                $crudRoutePart = 'fabric-nicknames';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('fabric_name', function ($row) {
                return $row->fabric ? $row->fabric->name : '';
            });

            $table->editColumn('fabric.fabric_code', function ($row) {
                return $row->fabric ? (is_string($row->fabric) ? $row->fabric : $row->fabric->fabric_code) : '';
            });
            $table->addColumn('customer_company_name', function ($row) {
                return $row->customer ? $row->customer->company_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fabric', 'customer']);

            return $table->make(true);
        }

        return view('admin.fabricNicknames.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_nickname_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabrics = Fabric::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fabricNicknames.create', compact('fabrics', 'customers'));
    }

    public function store(StoreFabricNicknameRequest $request)
    {
        $fabricNickname = FabricNickname::create($request->all());

        return redirect()->route('admin.fabric-nicknames.index');
    }

    public function edit(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabrics = Fabric::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabricNickname->load('fabric', 'customer');

        return view('admin.fabricNicknames.edit', compact('fabrics', 'customers', 'fabricNickname'));
    }

    public function update(UpdateFabricNicknameRequest $request, FabricNickname $fabricNickname)
    {
        $fabricNickname->update($request->all());

        return redirect()->route('admin.fabric-nicknames.index');
    }

    public function show(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricNickname->load('fabric', 'customer');

        return view('admin.fabricNicknames.show', compact('fabricNickname'));
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
