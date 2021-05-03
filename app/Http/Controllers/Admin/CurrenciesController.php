<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrencyRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Country;
use App\Models\Currency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CurrenciesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Currency::with(['countries'])->select(sprintf('%s.*', (new Currency())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'currency_show';
                $editGate = 'currency_edit';
                $deleteGate = 'currency_delete';
                $crudRoutePart = 'currencies';

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
            $table->editColumn('symbol', function ($row) {
                return $row->symbol ? $row->symbol : '';
            });
            $table->editColumn('alpha_3', function ($row) {
                return $row->alpha_3 ? $row->alpha_3 : '';
            });
            $table->editColumn('countries', function ($row) {
                $labels = [];
                foreach ($row->countries as $country) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $country->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'countries']);

            return $table->make(true);
        }

        $countries = Country::get();

        return view('admin.currencies.index', compact('countries'));
    }

    public function create()
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id');

        return view('admin.currencies.create', compact('countries'));
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->all());
        $currency->countries()->sync($request->input('countries', []));

        return redirect()->route('admin.currencies.index');
    }

    public function edit(Currency $currency)
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id');

        $currency->load('countries');

        return view('admin.currencies.edit', compact('countries', 'currency'));
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());
        $currency->countries()->sync($request->input('countries', []));

        return redirect()->route('admin.currencies.index');
    }

    public function show(Currency $currency)
    {
        abort_if(Gate::denies('currency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->load('countries', 'defaultCurrencyCountries', 'currencyCurrencyRates', 'currencyExpenses', 'currencyIncomes');

        return view('admin.currencies.show', compact('currency'));
    }

    public function destroy(Currency $currency)
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrencyRequest $request)
    {
        Currency::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
