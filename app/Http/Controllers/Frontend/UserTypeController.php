<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserTypeRequest;
use App\Http\Requests\StoreUserTypeRequest;
use App\Http\Requests\UpdateUserTypeRequest;
use App\Models\UserType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userTypes = UserType::all();

        return view('frontend.userTypes.index', compact('userTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.userTypes.create');
    }

    public function store(StoreUserTypeRequest $request)
    {
        $userType = UserType::create($request->all());

        return redirect()->route('frontend.user-types.index');
    }

    public function edit(UserType $userType)
    {
        abort_if(Gate::denies('user_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.userTypes.edit', compact('userType'));
    }

    public function update(UpdateUserTypeRequest $request, UserType $userType)
    {
        $userType->update($request->all());

        return redirect()->route('frontend.user-types.index');
    }

    public function show(UserType $userType)
    {
        abort_if(Gate::denies('user_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userType->load('authorisedUserTypesDocuments');

        return view('frontend.userTypes.show', compact('userType'));
    }

    public function destroy(UserType $userType)
    {
        abort_if(Gate::denies('user_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userType->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserTypeRequest $request)
    {
        UserType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
