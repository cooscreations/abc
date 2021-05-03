<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyComplaintStatusRequest;
use App\Http\Requests\StoreComplaintStatusRequest;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Models\ComplaintStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComplaintStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('complaint_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ComplaintStatus::query()->select(sprintf('%s.*', (new ComplaintStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'complaint_status_show';
                $editGate = 'complaint_status_edit';
                $deleteGate = 'complaint_status_delete';
                $crudRoutePart = 'complaint-statuses';

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
            $table->editColumn('list_order', function ($row) {
                return $row->list_order ? $row->list_order : '';
            });
            $table->editColumn('color_code', function ($row) {
                return $row->color_code ? $row->color_code : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.complaintStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaintStatuses.create');
    }

    public function store(StoreComplaintStatusRequest $request)
    {
        $complaintStatus = ComplaintStatus::create($request->all());

        return redirect()->route('admin.complaint-statuses.index');
    }

    public function edit(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaintStatuses.edit', compact('complaintStatus'));
    }

    public function update(UpdateComplaintStatusRequest $request, ComplaintStatus $complaintStatus)
    {
        $complaintStatus->update($request->all());

        return redirect()->route('admin.complaint-statuses.index');
    }

    public function show(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaintStatuses.show', compact('complaintStatus'));
    }

    public function destroy(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintStatusRequest $request)
    {
        ComplaintStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
