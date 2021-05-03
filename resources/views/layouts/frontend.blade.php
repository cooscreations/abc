<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('order_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.orderManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('order_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.orders.index') }}">
                                            {{ trans('cruds.order.title') }}
                                        </a>
                                    @endcan
                                    @can('order_item_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.order-items.index') }}">
                                            {{ trans('cruds.orderItem.title') }}
                                        </a>
                                    @endcan
                                    @can('shipping_container_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.shipping-containers.index') }}">
                                            {{ trans('cruds.shippingContainer.title') }}
                                        </a>
                                    @endcan
                                    @can('order_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.orderConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('order_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.order-statuses.index') }}">
                                            {{ trans('cruds.orderStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('order_role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.order-roles.index') }}">
                                            {{ trans('cruds.orderRole.title') }}
                                        </a>
                                    @endcan
                                    @can('ordertype_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.ordertypes.index') }}">
                                            {{ trans('cruds.ordertype.title') }}
                                        </a>
                                    @endcan
                                    @can('complaints_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.complaintsManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('complaint_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.complaints.index') }}">
                                            {{ trans('cruds.complaint.title') }}
                                        </a>
                                    @endcan
                                    @can('complaint_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.complaintConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('complaint_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.complaint-statuses.index') }}">
                                            {{ trans('cruds.complaintStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('user_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('user_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.user-types.index') }}">
                                            {{ trans('cruds.userType.title') }}
                                        </a>
                                    @endcan
                                    @can('user_alert_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.user-alerts.index') }}">
                                            {{ trans('cruds.userAlert.title') }}
                                        </a>
                                    @endcan
                                    @can('staff_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.staffManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('afa_staff_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.afa-staffs.index') }}">
                                            {{ trans('cruds.afaStaff.title') }}
                                        </a>
                                    @endcan
                                    @can('staff_level_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.staff-levels.index') }}">
                                            {{ trans('cruds.staffLevel.title') }}
                                        </a>
                                    @endcan
                                    @can('department_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.departments.index') }}">
                                            {{ trans('cruds.department.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.contactManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_company_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.contact-companies.index') }}">
                                            {{ trans('cruds.contactCompany.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_contact_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.contact-contacts.index') }}">
                                            {{ trans('cruds.contactContact.title') }}
                                        </a>
                                    @endcan
                                    @can('address_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.addresses.index') }}">
                                            {{ trans('cruds.address.title') }}
                                        </a>
                                    @endcan
                                    @can('contacts_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.contactsConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('company_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.company-types.index') }}">
                                            {{ trans('cruds.companyType.title') }}
                                        </a>
                                    @endcan
                                    @can('company_ownership_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.company-ownership-types.index') }}">
                                            {{ trans('cruds.companyOwnershipType.title') }}
                                        </a>
                                    @endcan
                                    @can('company_role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.company-roles.index') }}">
                                            {{ trans('cruds.companyRole.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.expenseManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.expenses.index') }}">
                                            {{ trans('cruds.expense.title') }}
                                        </a>
                                    @endcan
                                    @can('income_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.incomes.index') }}">
                                            {{ trans('cruds.income.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.expenseConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('currency_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.currencies.index') }}">
                                            {{ trans('cruds.currency.title') }}
                                        </a>
                                    @endcan
                                    @can('currency_rate_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.currency-rates.index') }}">
                                            {{ trans('cruds.currencyRate.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.expense-categories.index') }}">
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('income_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.income-categories.index') }}">
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('bank_account_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.bank-accounts.index') }}">
                                            {{ trans('cruds.bankAccount.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.faqManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-categories.index') }}">
                                            {{ trans('cruds.faqCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_question_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-questions.index') }}">
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </a>
                                    @endcan
                                    @can('product_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.productManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('product_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.products.index') }}">
                                            {{ trans('cruds.product.title') }}
                                        </a>
                                    @endcan
                                    @can('product_sku_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-skus.index') }}">
                                            {{ trans('cruds.productSku.title') }}
                                        </a>
                                    @endcan
                                    @can('product_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.productConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('product_collection_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-collections.index') }}">
                                            {{ trans('cruds.productCollection.title') }}
                                        </a>
                                    @endcan
                                    @can('product_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-groups.index') }}">
                                            {{ trans('cruds.productGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('product_function_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-functions.index') }}">
                                            {{ trans('cruds.productFunction.title') }}
                                        </a>
                                    @endcan
                                    @can('product_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-types.index') }}">
                                            {{ trans('cruds.productType.title') }}
                                        </a>
                                    @endcan
                                    @can('product_nickname_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-nicknames.index') }}">
                                            {{ trans('cruds.productNickname.title') }}
                                        </a>
                                    @endcan
                                    @can('product_development_stage_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-development-stages.index') }}">
                                            {{ trans('cruds.productDevelopmentStage.title') }}
                                        </a>
                                    @endcan
                                    @can('component_part_name_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.component-part-names.index') }}">
                                            {{ trans('cruds.componentPartName.title') }}
                                        </a>
                                    @endcan
                                    @can('product_size_name_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-size-names.index') }}">
                                            {{ trans('cruds.productSizeName.title') }}
                                        </a>
                                    @endcan
                                    @can('base_style_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.base-styles.index') }}">
                                            {{ trans('cruds.baseStyle.title') }}
                                        </a>
                                    @endcan
                                    @can('storage_option_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.storage-options.index') }}">
                                            {{ trans('cruds.storageOption.title') }}
                                        </a>
                                    @endcan
                                    @can('gas_lift_config_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.gas-lift-configs.index') }}">
                                            {{ trans('cruds.gasLiftConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('tv_bed_config_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tv-bed-configs.index') }}">
                                            {{ trans('cruds.tvBedConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('drawer_config_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.drawer-configs.index') }}">
                                            {{ trans('cruds.drawerConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('drawer_movement_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.drawer-movements.index') }}">
                                            {{ trans('cruds.drawerMovement.title') }}
                                        </a>
                                    @endcan
                                    @can('visitor_bed_config_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.visitor-bed-configs.index') }}">
                                            {{ trans('cruds.visitorBedConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('product_code_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-code-groups.index') }}">
                                            {{ trans('cruds.productCodeGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('bed_sizes_by_region_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.bed-sizes-by-regions.index') }}">
                                            {{ trans('cruds.bedSizesByRegion.title') }}
                                        </a>
                                    @endcan
                                    @can('bed_size_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.bed-size-groups.index') }}">
                                            {{ trans('cruds.bedSizeGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('product_sku_letter_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-sku-letters.index') }}">
                                            {{ trans('cruds.productSkuLetter.title') }}
                                        </a>
                                    @endcan
                                    @can('component_part_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.component-parts.index') }}">
                                            {{ trans('cruds.componentPart.title') }}
                                        </a>
                                    @endcan
                                    @can('cff_colour_fabric_finish_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.cffColourFabricFinish.title') }}
                                        </a>
                                    @endcan
                                    @can('fabric_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fabrics.index') }}">
                                            {{ trans('cruds.fabric.title') }}
                                        </a>
                                    @endcan
                                    @can('fabric_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fabric-groups.index') }}">
                                            {{ trans('cruds.fabricGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('fabric_price_band_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fabric-price-bands.index') }}">
                                            {{ trans('cruds.fabricPriceBand.title') }}
                                        </a>
                                    @endcan
                                    @can('raw_material_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.raw-material-types.index') }}">
                                            {{ trans('cruds.rawMaterialType.title') }}
                                        </a>
                                    @endcan
                                    @can('material_finish_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.material-finishes.index') }}">
                                            {{ trans('cruds.materialFinish.title') }}
                                        </a>
                                    @endcan
                                    @can('raw_material_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.raw-materials.index') }}">
                                            {{ trans('cruds.rawMaterial.title') }}
                                        </a>
                                    @endcan
                                    @can('fabric_nickname_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.fabric-nicknames.index') }}">
                                            {{ trans('cruds.fabricNickname.title') }}
                                        </a>
                                    @endcan
                                    @can('setting_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.setting.title') }}
                                        </a>
                                    @endcan
                                    @can('yes_no_maybe_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.yes-no-maybes.index') }}">
                                            {{ trans('cruds.yesNoMaybe.title') }}
                                        </a>
                                    @endcan
                                    @can('language_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.languages.index') }}">
                                            {{ trans('cruds.language.title') }}
                                        </a>
                                    @endcan
                                    @can('world_region_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.world-regions.index') }}">
                                            {{ trans('cruds.worldRegion.title') }}
                                        </a>
                                    @endcan
                                    @can('country_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.countries.index') }}">
                                            {{ trans('cruds.country.title') }}
                                        </a>
                                    @endcan
                                    @can('province_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.provinces.index') }}">
                                            {{ trans('cruds.province.title') }}
                                        </a>
                                    @endcan
                                    @can('price_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.priceManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('price_list_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.price-lists.index') }}">
                                            {{ trans('cruds.priceList.title') }}
                                        </a>
                                    @endcan
                                    @can('price_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.prices.index') }}">
                                            {{ trans('cruds.price.title') }}
                                        </a>
                                    @endcan
                                    @can('price_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.priceConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('price_list_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.price-list-types.index') }}">
                                            {{ trans('cruds.priceListType.title') }}
                                        </a>
                                    @endcan
                                    @can('price_list_group_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.price-list-groups.index') }}">
                                            {{ trans('cruds.priceListGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('equipment_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.equipmentManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('equipment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.equipment.index') }}">
                                            {{ trans('cruds.equipment.title') }}
                                        </a>
                                    @endcan
                                    @can('equipment_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.equipment-types.index') }}">
                                            {{ trans('cruds.equipmentType.title') }}
                                        </a>
                                    @endcan
                                    @can('equipment_audit_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.equipment-audits.index') }}">
                                            {{ trans('cruds.equipmentAudit.title') }}
                                        </a>
                                    @endcan
                                    @can('document_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.documentManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('document_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.documents.index') }}">
                                            {{ trans('cruds.document.title') }}
                                        </a>
                                    @endcan
                                    @can('document_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.documentConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('document_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.document-types.index') }}">
                                            {{ trans('cruds.documentType.title') }}
                                        </a>
                                    @endcan
                                    @can('file_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.file-types.index') }}">
                                            {{ trans('cruds.fileType.title') }}
                                        </a>
                                    @endcan
                                    @can('packaging_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.packagingManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('packaging_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.packagings.index') }}">
                                            {{ trans('cruds.packaging.title') }}
                                        </a>
                                    @endcan
                                    @can('packaging_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.packagingConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('packaging_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.packaging-types.index') }}">
                                            {{ trans('cruds.packagingType.title') }}
                                        </a>
                                    @endcan
                                    @can('inspection_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.inspectionManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('inspection_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.inspections.index') }}">
                                            {{ trans('cruds.inspection.title') }}
                                        </a>
                                    @endcan
                                    @can('supplier_audit_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.supplier-audits.index') }}">
                                            {{ trans('cruds.supplierAudit.title') }}
                                        </a>
                                    @endcan
                                    @can('inspection_config_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.inspectionConfig.title') }}
                                        </a>
                                    @endcan
                                    @can('inspection_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.inspection-statuses.index') }}">
                                            {{ trans('cruds.inspectionStatus.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>