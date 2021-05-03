<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Complaints
    Route::apiResource('complaints', 'ComplaintsApiController');

    // Storage Options
    Route::post('storage-options/media', 'StorageOptionsApiController@storeMedia')->name('storage-options.storeMedia');
    Route::apiResource('storage-options', 'StorageOptionsApiController');

    // Product Collections
    Route::apiResource('product-collections', 'ProductCollectionsApiController');

    // Gas Lift Config
    Route::post('gas-lift-configs/media', 'GasLiftConfigApiController@storeMedia')->name('gas-lift-configs.storeMedia');
    Route::apiResource('gas-lift-configs', 'GasLiftConfigApiController');

    // Tv Bed Config
    Route::post('tv-bed-configs/media', 'TvBedConfigApiController@storeMedia')->name('tv-bed-configs.storeMedia');
    Route::apiResource('tv-bed-configs', 'TvBedConfigApiController');

    // Drawer Config
    Route::post('drawer-configs/media', 'DrawerConfigApiController@storeMedia')->name('drawer-configs.storeMedia');
    Route::apiResource('drawer-configs', 'DrawerConfigApiController');

    // Visitor Bed Config
    Route::post('visitor-bed-configs/media', 'VisitorBedConfigApiController@storeMedia')->name('visitor-bed-configs.storeMedia');
    Route::apiResource('visitor-bed-configs', 'VisitorBedConfigApiController');

    // Staff Levels
    Route::apiResource('staff-levels', 'StaffLevelsApiController');

    // User Type
    Route::apiResource('user-types', 'UserTypeApiController');

    // Raw Material Types
    Route::post('raw-material-types/media', 'RawMaterialTypesApiController@storeMedia')->name('raw-material-types.storeMedia');
    Route::apiResource('raw-material-types', 'RawMaterialTypesApiController');

    // Yes No Maybe
    Route::apiResource('yes-no-maybes', 'YesNoMaybeApiController');

    // Material Finish
    Route::post('material-finishes/media', 'MaterialFinishApiController@storeMedia')->name('material-finishes.storeMedia');
    Route::apiResource('material-finishes', 'MaterialFinishApiController');

    // Countries
    Route::post('countries/media', 'CountriesApiController@storeMedia')->name('countries.storeMedia');
    Route::apiResource('countries', 'CountriesApiController');

    // World Regions
    Route::post('world-regions/media', 'WorldRegionsApiController@storeMedia')->name('world-regions.storeMedia');
    Route::apiResource('world-regions', 'WorldRegionsApiController');

    // Currencies
    Route::apiResource('currencies', 'CurrenciesApiController');

    // Languages
    Route::apiResource('languages', 'LanguagesApiController');

    // Currency Rates
    Route::apiResource('currency-rates', 'CurrencyRatesApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Contact Company
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::post('contact-contacts/media', 'ContactContactsApiController@storeMedia')->name('contact-contacts.storeMedia');
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Company Types
    Route::post('company-types/media', 'CompanyTypesApiController@storeMedia')->name('company-types.storeMedia');
    Route::apiResource('company-types', 'CompanyTypesApiController');

    // Products
    Route::post('products/media', 'ProductsApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductsApiController');

    // Raw Material
    Route::post('raw-materials/media', 'RawMaterialApiController@storeMedia')->name('raw-materials.storeMedia');
    Route::apiResource('raw-materials', 'RawMaterialApiController');

    // Product Nicknames
    Route::post('product-nicknames/media', 'ProductNicknamesApiController@storeMedia')->name('product-nicknames.storeMedia');
    Route::apiResource('product-nicknames', 'ProductNicknamesApiController');

    // Company Ownership Types
    Route::apiResource('company-ownership-types', 'CompanyOwnershipTypesApiController');

    // Orders
    Route::apiResource('orders', 'OrdersApiController');

    // Addresses
    Route::apiResource('addresses', 'AddressesApiController');

    // Provinces
    Route::post('provinces/media', 'ProvincesApiController@storeMedia')->name('provinces.storeMedia');
    Route::apiResource('provinces', 'ProvincesApiController');

    // Afa Staff
    Route::apiResource('afa-staffs', 'AfaStaffApiController');

    // Product Sku
    Route::apiResource('product-skus', 'ProductSkuApiController');

    // Order Items
    Route::apiResource('order-items', 'OrderItemsApiController');

    // Drawer Movement
    Route::apiResource('drawer-movements', 'DrawerMovementApiController');

    // Shipping Containers
    Route::apiResource('shipping-containers', 'ShippingContainersApiController');

    // Order Status
    Route::apiResource('order-statuses', 'OrderStatusApiController');

    // Price List Types
    Route::apiResource('price-list-types', 'PriceListTypesApiController');

    // Base Styles
    Route::apiResource('base-styles', 'BaseStylesApiController');

    // Order Roles
    Route::apiResource('order-roles', 'OrderRolesApiController');

    // Complaint Status
    Route::apiResource('complaint-statuses', 'ComplaintStatusApiController');

    // Price List Groups
    Route::apiResource('price-list-groups', 'PriceListGroupsApiController');

    // Company Roles
    Route::apiResource('company-roles', 'CompanyRolesApiController');

    // Component Part Names
    Route::post('component-part-names/media', 'ComponentPartNamesApiController@storeMedia')->name('component-part-names.storeMedia');
    Route::apiResource('component-part-names', 'ComponentPartNamesApiController');

    // Product Size Names
    Route::apiResource('product-size-names', 'ProductSizeNamesApiController');

    // Equipment Type
    Route::apiResource('equipment-types', 'EquipmentTypeApiController');

    // Equipment
    Route::post('equipment/media', 'EquipmentApiController@storeMedia')->name('equipment.storeMedia');
    Route::apiResource('equipment', 'EquipmentApiController');

    // Equipment Audit
    Route::apiResource('equipment-audits', 'EquipmentAuditApiController');

    // Document Types
    Route::apiResource('document-types', 'DocumentTypesApiController');

    // File Types
    Route::apiResource('file-types', 'FileTypesApiController');

    // Documents
    Route::apiResource('documents', 'DocumentsApiController');

    // Price Lists
    Route::apiResource('price-lists', 'PriceListsApiController');

    // Product Code Groups
    Route::apiResource('product-code-groups', 'ProductCodeGroupsApiController');

    // Product Functions
    Route::apiResource('product-functions', 'ProductFunctionsApiController');

    // Product Development Stages
    Route::apiResource('product-development-stages', 'ProductDevelopmentStagesApiController');

    // Packaging Types
    Route::post('packaging-types/media', 'PackagingTypesApiController@storeMedia')->name('packaging-types.storeMedia');
    Route::apiResource('packaging-types', 'PackagingTypesApiController');

    // Packaging
    Route::apiResource('packagings', 'PackagingApiController');

    // Prices
    Route::apiResource('prices', 'PricesApiController');

    // Fabric Groups
    Route::post('fabric-groups/media', 'FabricGroupsApiController@storeMedia')->name('fabric-groups.storeMedia');
    Route::apiResource('fabric-groups', 'FabricGroupsApiController');

    // Departments
    Route::post('departments/media', 'DepartmentsApiController@storeMedia')->name('departments.storeMedia');
    Route::apiResource('departments', 'DepartmentsApiController');

    // Bank Accounts
    Route::apiResource('bank-accounts', 'BankAccountsApiController');

    // Fabric
    Route::apiResource('fabrics', 'FabricApiController');

    // Fabric Price Bands
    Route::post('fabric-price-bands/media', 'FabricPriceBandsApiController@storeMedia')->name('fabric-price-bands.storeMedia');
    Route::apiResource('fabric-price-bands', 'FabricPriceBandsApiController');

    // Fabric Nicknames
    Route::apiResource('fabric-nicknames', 'FabricNicknamesApiController');

    // Product Groups
    Route::post('product-groups/media', 'ProductGroupsApiController@storeMedia')->name('product-groups.storeMedia');
    Route::apiResource('product-groups', 'ProductGroupsApiController');

    // Bed Sizes By Region
    Route::apiResource('bed-sizes-by-regions', 'BedSizesByRegionApiController');

    // Bed Size Groups
    Route::post('bed-size-groups/media', 'BedSizeGroupsApiController@storeMedia')->name('bed-size-groups.storeMedia');
    Route::apiResource('bed-size-groups', 'BedSizeGroupsApiController');

    // Inspections
    Route::apiResource('inspections', 'InspectionsApiController');

    // Ordertype
    Route::apiResource('ordertypes', 'OrdertypeApiController');

    // Product Type
    Route::apiResource('product-types', 'ProductTypeApiController');

    // Product Sku Letters
    Route::apiResource('product-sku-letters', 'ProductSkuLettersApiController');

    // Component Parts
    Route::apiResource('component-parts', 'ComponentPartsApiController');

    // Supplier Audit
    Route::apiResource('supplier-audits', 'SupplierAuditApiController');

    // Inspection Status
    Route::apiResource('inspection-statuses', 'InspectionStatusApiController');
});
