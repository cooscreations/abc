<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPackagingRequest;
use App\Http\Requests\StorePackagingRequest;
use App\Http\Requests\UpdatePackagingRequest;
use App\Models\Packaging;
use App\Models\PackagingType;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackagingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('packaging_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagings = Packaging::with(['product', 'type'])->get();

        return view('admin.packagings.index', compact('packagings'));
    }

    public function create()
    {
        abort_if(Gate::denies('packaging_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = PackagingType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packagings.create', compact('products', 'types'));
    }

    public function store(StorePackagingRequest $request)
    {
        $packaging = Packaging::create($request->all());

        return redirect()->route('admin.packagings.index');
    }

    public function edit(Packaging $packaging)
    {
        abort_if(Gate::denies('packaging_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = PackagingType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packaging->load('product', 'type');

        return view('admin.packagings.edit', compact('products', 'types', 'packaging'));
    }

    public function update(UpdatePackagingRequest $request, Packaging $packaging)
    {
        $packaging->update($request->all());

        return redirect()->route('admin.packagings.index');
    }

    public function show(Packaging $packaging)
    {
        abort_if(Gate::denies('packaging_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packaging->load('product', 'type', 'stdPackagingProducts');

        return view('admin.packagings.show', compact('packaging'));
    }

    public function destroy(Packaging $packaging)
    {
        abort_if(Gate::denies('packaging_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packaging->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackagingRequest $request)
    {
        Packaging::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
