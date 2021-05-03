<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLanguageRequest;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguagesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all();

        return view('frontend.languages.index', compact('languages'));
    }

    public function create()
    {
        abort_if(Gate::denies('language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        $language = Language::create($request->all());

        return redirect()->route('frontend.languages.index');
    }

    public function edit(Language $language)
    {
        abort_if(Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.languages.edit', compact('language'));
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        return redirect()->route('frontend.languages.index');
    }

    public function show(Language $language)
    {
        abort_if(Gate::denies('language_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->load('defaultLanguageContactContacts');

        return view('frontend.languages.show', compact('language'));
    }

    public function destroy(Language $language)
    {
        abort_if(Gate::denies('language_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->delete();

        return back();
    }

    public function massDestroy(MassDestroyLanguageRequest $request)
    {
        Language::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
