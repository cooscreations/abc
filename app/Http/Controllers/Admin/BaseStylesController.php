<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBaseStyleRequest;
use App\Http\Requests\StoreBaseStyleRequest;
use App\Http\Requests\UpdateBaseStyleRequest;
use App\Models\BaseStyle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BaseStylesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('base_style_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BaseStyle::query()->select(sprintf('%s.*', (new BaseStyle())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'base_style_show';
                $editGate = 'base_style_edit';
                $deleteGate = 'base_style_delete';
                $crudRoutePart = 'base-styles';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.baseStyles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('base_style_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.baseStyles.create');
    }

    public function store(StoreBaseStyleRequest $request)
    {
        $baseStyle = BaseStyle::create($request->all());

        return redirect()->route('admin.base-styles.index');
    }

    public function edit(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.baseStyles.edit', compact('baseStyle'));
    }

    public function update(UpdateBaseStyleRequest $request, BaseStyle $baseStyle)
    {
        $baseStyle->update($request->all());

        return redirect()->route('admin.base-styles.index');
    }

    public function show(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baseStyle->load('baseStyleBedSizesByRegions');

        return view('admin.baseStyles.show', compact('baseStyle'));
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
