<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrencyRateRequest;
use App\Http\Requests\UpdateCurrencyRateRequest;
use App\Http\Resources\Admin\CurrencyRateResource;
use App\Models\CurrencyRate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrencyRatesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('currency_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrencyRateResource(CurrencyRate::with(['currency'])->get());
    }

    public function store(StoreCurrencyRateRequest $request)
    {
        $currencyRate = CurrencyRate::create($request->all());

        return (new CurrencyRateResource($currencyRate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrencyRateResource($currencyRate->load(['currency']));
    }

    public function update(UpdateCurrencyRateRequest $request, CurrencyRate $currencyRate)
    {
        $currencyRate->update($request->all());

        return (new CurrencyRateResource($currencyRate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencyRate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
