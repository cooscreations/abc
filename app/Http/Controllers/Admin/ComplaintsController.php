<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyComplaintRequest;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComplaintsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Complaint::query()->select(sprintf('%s.*', (new Complaint())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'complaint_show';
                $editGate = 'complaint_edit';
                $deleteGate = 'complaint_delete';
                $crudRoutePart = 'complaints';

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
            $table->editColumn('afa_case_number', function ($row) {
                return $row->afa_case_number ? $row->afa_case_number : '';
            });
            $table->editColumn('qty_affected', function ($row) {
                return $row->qty_affected ? $row->qty_affected : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.complaints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaints.create');
    }

    public function store(StoreComplaintRequest $request)
    {
        $complaint = Complaint::create($request->all());

        return redirect()->route('admin.complaints.index');
    }

    public function edit(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaints.edit', compact('complaint'));
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $complaint->update($request->all());

        return redirect()->route('admin.complaints.index');
    }

    public function show(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaints.show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintRequest $request)
    {
        Complaint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
