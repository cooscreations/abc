<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Models\Currency;
use App\Models\WorldRegion;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CountriesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::with(['world_region', 'default_currency'])->get();

        return view('frontend.countries.index', compact('countries'));
    }

    public function create()
    {
        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.countries.create', compact('world_regions', 'default_currencies'));
    }

    public function store(StoreCountryRequest $request)
    {
        $country = Country::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $country->id]);
        }

        return redirect()->route('frontend.countries.index');
    }

    public function edit(Country $country)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $country->load('world_region', 'default_currency');

        return view('frontend.countries.edit', compact('world_regions', 'default_currencies', 'country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->all());

        return redirect()->route('frontend.countries.index');
    }

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->load('world_region', 'default_currency', 'regCountryContactCompanies', 'countryAddresses', 'countryProvinces', 'countryOfBirthContactContacts', 'currentCountryContactContacts', 'client1CountrySupplierAudits', 'client2CountrySupplierAudits', 'client3CountrySupplierAudits', 'countriesCurrencies', 'exportCountriesSupplierAudits');

        return view('frontend.countries.show', compact('country'));
    }

    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->delete();

        return back();
    }

    public function massDestroy(MassDestroyCountryRequest $request)
    {
        Country::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('country_create') && Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Country();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
