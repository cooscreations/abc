<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductNicknameRequest;
use App\Http\Requests\UpdateProductNicknameRequest;
use App\Http\Resources\Admin\ProductNicknameResource;
use App\Models\ProductNickname;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductNicknamesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_nickname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductNicknameResource(ProductNickname::with(['company', 'product'])->get());
    }

    public function store(StoreProductNicknameRequest $request)
    {
        $productNickname = ProductNickname::create($request->all());

        return (new ProductNicknameResource($productNickname))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductNickname $productNickname)
    {
        abort_if(Gate::denies('product_nickname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductNicknameResource($productNickname->load(['company', 'product']));
    }

    public function update(UpdateProductNicknameRequest $request, ProductNickname $productNickname)
    {
        $productNickname->update($request->all());

        return (new ProductNicknameResource($productNickname))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductNickname $productNickname)
    {
        abort_if(Gate::denies('product_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productNickname->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
