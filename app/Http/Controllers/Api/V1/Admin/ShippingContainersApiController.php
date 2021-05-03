<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingContainerRequest;
use App\Http\Requests\UpdateShippingContainerRequest;
use App\Http\Resources\Admin\ShippingContainerResource;
use App\Models\ShippingContainer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippingContainersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipping_container_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingContainerResource(ShippingContainer::with(['order', 'shipping_company'])->get());
    }

    public function store(StoreShippingContainerRequest $request)
    {
        $shippingContainer = ShippingContainer::create($request->all());

        return (new ShippingContainerResource($shippingContainer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingContainerResource($shippingContainer->load(['order', 'shipping_company']));
    }

    public function update(UpdateShippingContainerRequest $request, ShippingContainer $shippingContainer)
    {
        $shippingContainer->update($request->all());

        return (new ShippingContainerResource($shippingContainer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingContainer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
