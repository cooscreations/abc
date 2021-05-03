<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductNicknameRequest;
use App\Http\Requests\StoreProductNicknameRequest;
use App\Http\Requests\UpdateProductNicknameRequest;
use App\Models\ContactCompany;
use App\Models\Product;
use App\Models\ProductNickname;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductNicknamesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_nickname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductNickname::with(['company', 'product'])->select(sprintf('%s.*', (new ProductNickname())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_nickname_show';
                $editGate = 'product_nickname_edit';
                $deleteGate = 'product_nickname_delete';
                $crudRoutePart = 'product-nicknames';

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
            $table->addColumn('product_afa_model_number', function ($row) {
                return $row->product ? $row->product->afa_model_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        $contact_companies = ContactCompany::get();
        $products          = Product::get();

        return view('admin.productNicknames.index', compact('contact_companies', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_nickname_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productNicknames.create', compact('companies', 'products'));
    }

    public function store(StoreProductNicknameRequest $request)
    {
        $productNickname = ProductNickname::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productNickname->id]);
        }

        return redirect()->route('admin.product-nicknames.index');
    }

    public function edit(ProductNickname $productNickname)
    {
        abort_if(Gate::denies('product_nickname_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productNickname->load('company', 'product');

        return view('admin.productNicknames.edit', compact('companies', 'products', 'productNickname'));
    }

    public function update(UpdateProductNicknameRequest $request, ProductNickname $productNickname)
    {
        $productNickname->update($request->all());

        return redirect()->route('admin.product-nicknames.index');
    }

    public function show(ProductNickname $productNickname)
    {
        abort_if(Gate::denies('product_nickname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productNickname->load('company', 'product', 'primaryNicknameProducts');

        return view('admin.productNicknames.show', compact('productNickname'));
    }

    public function destroy(ProductNickname $productNickname)
    {
        abort_if(Gate::denies('product_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productNickname->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductNicknameRequest $request)
    {
        ProductNickname::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_nickname_create') && Gate::denies('product_nickname_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductNickname();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
