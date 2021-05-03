<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ContactCompany;
use App\Models\DrawerConfig;
use App\Models\DrawerMovement;
use App\Models\GasLiftConfig;
use App\Models\Packaging;
use App\Models\Product;
use App\Models\ProductCodeGroup;
use App\Models\ProductCollection;
use App\Models\ProductFunction;
use App\Models\ProductGroup;
use App\Models\ProductNickname;
use App\Models\ProductSkuLetter;
use App\Models\RawMaterial;
use App\Models\StorageOption;
use App\Models\TvBedConfig;
use App\Models\VisitorBedConfig;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::with(['primary_nickname', 'product_code_group', 'default_function', 'product_collection', 'default_group', 'default_storage', 'default_gas_lift_config', 'default_drawer_config', 'default_drawer_movement', 'default_tv_config', 'default_visitor_config', 'extra_letters_used_in_skus', 'primary_material', 'primary_suppliers', 'std_packaging', 'media'])->get();

        $product_nicknames = ProductNickname::get();

        $product_code_groups = ProductCodeGroup::get();

        $product_functions = ProductFunction::get();

        $product_collections = ProductCollection::get();

        $product_groups = ProductGroup::get();

        $storage_options = StorageOption::get();

        $gas_lift_configs = GasLiftConfig::get();

        $drawer_configs = DrawerConfig::get();

        $drawer_movements = DrawerMovement::get();

        $tv_bed_configs = TvBedConfig::get();

        $visitor_bed_configs = VisitorBedConfig::get();

        $product_sku_letters = ProductSkuLetter::get();

        $raw_materials = RawMaterial::get();

        $contact_companies = ContactCompany::get();

        $packagings = Packaging::get();

        return view('frontend.products.index', compact('products', 'product_nicknames', 'product_code_groups', 'product_functions', 'product_collections', 'product_groups', 'storage_options', 'gas_lift_configs', 'drawer_configs', 'drawer_movements', 'tv_bed_configs', 'visitor_bed_configs', 'product_sku_letters', 'raw_materials', 'contact_companies', 'packagings'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_nicknames = ProductNickname::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_code_groups = ProductCodeGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_functions = ProductFunction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_collections = ProductCollection::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_groups = ProductGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_storages = StorageOption::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_gas_lift_configs = GasLiftConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_drawer_configs = DrawerConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_drawer_movements = DrawerMovement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_tv_configs = TvBedConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_visitor_configs = VisitorBedConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $extra_letters_used_in_skus = ProductSkuLetter::all()->pluck('letter_code', 'id');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_suppliers = ContactCompany::all()->pluck('company_short_code', 'id');

        $std_packagings = Packaging::all()->pluck('notes', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.products.create', compact('primary_nicknames', 'product_code_groups', 'default_functions', 'product_collections', 'default_groups', 'default_storages', 'default_gas_lift_configs', 'default_drawer_configs', 'default_drawer_movements', 'default_tv_configs', 'default_visitor_configs', 'extra_letters_used_in_skus', 'primary_materials', 'primary_suppliers', 'std_packagings'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->extra_letters_used_in_skus()->sync($request->input('extra_letters_used_in_skus', []));
        $product->primary_suppliers()->sync($request->input('primary_suppliers', []));
        if ($request->input('beauty_shot', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('beauty_shot'))))->toMediaCollection('beauty_shot');
        }

        if ($request->input('iso_naked', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('iso_naked'))))->toMediaCollection('iso_naked');
        }

        foreach ($request->input('other_photos', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('other_photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('frontend.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_nicknames = ProductNickname::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_code_groups = ProductCodeGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_functions = ProductFunction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_collections = ProductCollection::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_groups = ProductGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_storages = StorageOption::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_gas_lift_configs = GasLiftConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_drawer_configs = DrawerConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_drawer_movements = DrawerMovement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_tv_configs = TvBedConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_visitor_configs = VisitorBedConfig::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $extra_letters_used_in_skus = ProductSkuLetter::all()->pluck('letter_code', 'id');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_suppliers = ContactCompany::all()->pluck('company_short_code', 'id');

        $std_packagings = Packaging::all()->pluck('notes', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('primary_nickname', 'product_code_group', 'default_function', 'product_collection', 'default_group', 'default_storage', 'default_gas_lift_config', 'default_drawer_config', 'default_drawer_movement', 'default_tv_config', 'default_visitor_config', 'extra_letters_used_in_skus', 'primary_material', 'primary_suppliers', 'std_packaging');

        return view('frontend.products.edit', compact('primary_nicknames', 'product_code_groups', 'default_functions', 'product_collections', 'default_groups', 'default_storages', 'default_gas_lift_configs', 'default_drawer_configs', 'default_drawer_movements', 'default_tv_configs', 'default_visitor_configs', 'extra_letters_used_in_skus', 'primary_materials', 'primary_suppliers', 'std_packagings', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->extra_letters_used_in_skus()->sync($request->input('extra_letters_used_in_skus', []));
        $product->primary_suppliers()->sync($request->input('primary_suppliers', []));
        if ($request->input('beauty_shot', false)) {
            if (!$product->beauty_shot || $request->input('beauty_shot') !== $product->beauty_shot->file_name) {
                if ($product->beauty_shot) {
                    $product->beauty_shot->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('beauty_shot'))))->toMediaCollection('beauty_shot');
            }
        } elseif ($product->beauty_shot) {
            $product->beauty_shot->delete();
        }

        if ($request->input('iso_naked', false)) {
            if (!$product->iso_naked || $request->input('iso_naked') !== $product->iso_naked->file_name) {
                if ($product->iso_naked) {
                    $product->iso_naked->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('iso_naked'))))->toMediaCollection('iso_naked');
            }
        } elseif ($product->iso_naked) {
            $product->iso_naked->delete();
        }

        if (count($product->other_photos) > 0) {
            foreach ($product->other_photos as $media) {
                if (!in_array($media->file_name, $request->input('other_photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->other_photos->pluck('file_name')->toArray();
        foreach ($request->input('other_photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('other_photos');
            }
        }

        return redirect()->route('frontend.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('primary_nickname', 'product_code_group', 'default_function', 'product_collection', 'default_group', 'default_storage', 'default_gas_lift_config', 'default_drawer_config', 'default_drawer_movement', 'default_tv_config', 'default_visitor_config', 'extra_letters_used_in_skus', 'primary_material', 'primary_suppliers', 'std_packaging', 'productProductNicknames', 'productProductSkus', 'productOrderItems', 'productPackagings', 'relatedProductsDocuments');

        return view('frontend.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
