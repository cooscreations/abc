<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyYesNoMaybeRequest;
use App\Http\Requests\StoreYesNoMaybeRequest;
use App\Http\Requests\UpdateYesNoMaybeRequest;
use App\Models\YesNoMaybe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class YesNoMaybeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('yes_no_maybe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = YesNoMaybe::query()->select(sprintf('%s.*', (new YesNoMaybe())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'yes_no_maybe_show';
                $editGate = 'yes_no_maybe_edit';
                $deleteGate = 'yes_no_maybe_delete';
                $crudRoutePart = 'yes-no-maybes';

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
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.yesNoMaybes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('yes_no_maybe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yesNoMaybes.create');
    }

    public function store(StoreYesNoMaybeRequest $request)
    {
        $yesNoMaybe = YesNoMaybe::create($request->all());

        return redirect()->route('admin.yes-no-maybes.index');
    }

    public function edit(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yesNoMaybes.edit', compact('yesNoMaybe'));
    }

    public function update(UpdateYesNoMaybeRequest $request, YesNoMaybe $yesNoMaybe)
    {
        $yesNoMaybe->update($request->all());

        return redirect()->route('admin.yes-no-maybes.index');
    }

    public function show(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yesNoMaybes.show', compact('yesNoMaybe'));
    }

    public function destroy(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yesNoMaybe->delete();

        return back();
    }

    public function massDestroy(MassDestroyYesNoMaybeRequest $request)
    {
        YesNoMaybe::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
