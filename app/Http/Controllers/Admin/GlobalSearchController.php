<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'ContactCompany'          => 'cruds.contactCompany.title',
        'ContactContact'          => 'cruds.contactContact.title',
        'CompanyType'             => 'cruds.companyType.title',
        'Product'                 => 'cruds.product.title',
        'ProductNickname'         => 'cruds.productNickname.title',
        'CompanyOwnershipType'    => 'cruds.companyOwnershipType.title',
        'Order'                   => 'cruds.order.title',
        'Address'                 => 'cruds.address.title',
        'Province'                => 'cruds.province.title',
        'AfaStaff'                => 'cruds.afaStaff.title',
        'ProductSku'              => 'cruds.productSku.title',
        'DrawerMovement'          => 'cruds.drawerMovement.title',
        'ShippingContainer'       => 'cruds.shippingContainer.title',
        'PriceListType'           => 'cruds.priceListType.title',
        'BaseStyle'               => 'cruds.baseStyle.title',
        'ComponentPartName'       => 'cruds.componentPartName.title',
        'EquipmentType'           => 'cruds.equipmentType.title',
        'Equipment'               => 'cruds.equipment.title',
        'Document'                => 'cruds.document.title',
        'PriceList'               => 'cruds.priceList.title',
        'ProductCodeGroup'        => 'cruds.productCodeGroup.title',
        'ProductFunction'         => 'cruds.productFunction.title',
        'ProductDevelopmentStage' => 'cruds.productDevelopmentStage.title',
        'PackagingType'           => 'cruds.packagingType.title',
        'Packaging'               => 'cruds.packaging.title',
        'Price'                   => 'cruds.price.title',
        'FabricGroup'             => 'cruds.fabricGroup.title',
        'Department'              => 'cruds.department.title',
        'BankAccount'             => 'cruds.bankAccount.title',
        'Fabric'                  => 'cruds.fabric.title',
        'FabricPriceBand'         => 'cruds.fabricPriceBand.title',
        'FabricNickname'          => 'cruds.fabricNickname.title',
        'ProductGroup'            => 'cruds.productGroup.title',
        'BedSizesByRegion'        => 'cruds.bedSizesByRegion.title',
        'BedSizeGroup'            => 'cruds.bedSizeGroup.title',
        'Inspection'              => 'cruds.inspection.title',
        'ProductType'             => 'cruds.productType.title',
        'ProductSkuLetter'        => 'cruds.productSkuLetter.title',
        'SupplierAudit'           => 'cruds.supplierAudit.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
