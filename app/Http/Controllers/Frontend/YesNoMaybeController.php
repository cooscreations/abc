<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyYesNoMaybeRequest;
use App\Http\Requests\StoreYesNoMaybeRequest;
use App\Http\Requests\UpdateYesNoMaybeRequest;
use App\Models\YesNoMaybe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YesNoMaybeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('yes_no_maybe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yesNoMaybes = YesNoMaybe::all();

        return view('frontend.yesNoMaybes.index', compact('yesNoMaybes'));
    }

    public function create()
    {
        abort_if(Gate::denies('yes_no_maybe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.yesNoMaybes.create');
    }

    public function store(StoreYesNoMaybeRequest $request)
    {
        $yesNoMaybe = YesNoMaybe::create($request->all());

        return redirect()->route('frontend.yes-no-maybes.index');
    }

    public function edit(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.yesNoMaybes.edit', compact('yesNoMaybe'));
    }

    public function update(UpdateYesNoMaybeRequest $request, YesNoMaybe $yesNoMaybe)
    {
        $yesNoMaybe->update($request->all());

        return redirect()->route('frontend.yes-no-maybes.index');
    }

    public function show(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.yesNoMaybes.show', compact('yesNoMaybe'));
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
