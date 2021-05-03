<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Complaints
    Route::delete('complaints/destroy', 'ComplaintsController@massDestroy')->name('complaints.massDestroy');
    Route::post('complaints/parse-csv-import', 'ComplaintsController@parseCsvImport')->name('complaints.parseCsvImport');
    Route::post('complaints/process-csv-import', 'ComplaintsController@processCsvImport')->name('complaints.processCsvImport');
    Route::resource('complaints', 'ComplaintsController');

    // Storage Options
    Route::delete('storage-options/destroy', 'StorageOptionsController@massDestroy')->name('storage-options.massDestroy');
    Route::post('storage-options/media', 'StorageOptionsController@storeMedia')->name('storage-options.storeMedia');
    Route::post('storage-options/ckmedia', 'StorageOptionsController@storeCKEditorImages')->name('storage-options.storeCKEditorImages');
    Route::post('storage-options/parse-csv-import', 'StorageOptionsController@parseCsvImport')->name('storage-options.parseCsvImport');
    Route::post('storage-options/process-csv-import', 'StorageOptionsController@processCsvImport')->name('storage-options.processCsvImport');
    Route::resource('storage-options', 'StorageOptionsController');

    // Product Collections
    Route::delete('product-collections/destroy', 'ProductCollectionsController@massDestroy')->name('product-collections.massDestroy');
    Route::post('product-collections/parse-csv-import', 'ProductCollectionsController@parseCsvImport')->name('product-collections.parseCsvImport');
    Route::post('product-collections/process-csv-import', 'ProductCollectionsController@processCsvImport')->name('product-collections.processCsvImport');
    Route::resource('product-collections', 'ProductCollectionsController');

    // Gas Lift Config
    Route::delete('gas-lift-configs/destroy', 'GasLiftConfigController@massDestroy')->name('gas-lift-configs.massDestroy');
    Route::post('gas-lift-configs/media', 'GasLiftConfigController@storeMedia')->name('gas-lift-configs.storeMedia');
    Route::post('gas-lift-configs/ckmedia', 'GasLiftConfigController@storeCKEditorImages')->name('gas-lift-configs.storeCKEditorImages');
    Route::post('gas-lift-configs/parse-csv-import', 'GasLiftConfigController@parseCsvImport')->name('gas-lift-configs.parseCsvImport');
    Route::post('gas-lift-configs/process-csv-import', 'GasLiftConfigController@processCsvImport')->name('gas-lift-configs.processCsvImport');
    Route::resource('gas-lift-configs', 'GasLiftConfigController');

    // Tv Bed Config
    Route::delete('tv-bed-configs/destroy', 'TvBedConfigController@massDestroy')->name('tv-bed-configs.massDestroy');
    Route::post('tv-bed-configs/media', 'TvBedConfigController@storeMedia')->name('tv-bed-configs.storeMedia');
    Route::post('tv-bed-configs/ckmedia', 'TvBedConfigController@storeCKEditorImages')->name('tv-bed-configs.storeCKEditorImages');
    Route::post('tv-bed-configs/parse-csv-import', 'TvBedConfigController@parseCsvImport')->name('tv-bed-configs.parseCsvImport');
    Route::post('tv-bed-configs/process-csv-import', 'TvBedConfigController@processCsvImport')->name('tv-bed-configs.processCsvImport');
    Route::resource('tv-bed-configs', 'TvBedConfigController');

    // Drawer Config
    Route::delete('drawer-configs/destroy', 'DrawerConfigController@massDestroy')->name('drawer-configs.massDestroy');
    Route::post('drawer-configs/media', 'DrawerConfigController@storeMedia')->name('drawer-configs.storeMedia');
    Route::post('drawer-configs/ckmedia', 'DrawerConfigController@storeCKEditorImages')->name('drawer-configs.storeCKEditorImages');
    Route::post('drawer-configs/parse-csv-import', 'DrawerConfigController@parseCsvImport')->name('drawer-configs.parseCsvImport');
    Route::post('drawer-configs/process-csv-import', 'DrawerConfigController@processCsvImport')->name('drawer-configs.processCsvImport');
    Route::resource('drawer-configs', 'DrawerConfigController');

    // Visitor Bed Config
    Route::delete('visitor-bed-configs/destroy', 'VisitorBedConfigController@massDestroy')->name('visitor-bed-configs.massDestroy');
    Route::post('visitor-bed-configs/media', 'VisitorBedConfigController@storeMedia')->name('visitor-bed-configs.storeMedia');
    Route::post('visitor-bed-configs/ckmedia', 'VisitorBedConfigController@storeCKEditorImages')->name('visitor-bed-configs.storeCKEditorImages');
    Route::post('visitor-bed-configs/parse-csv-import', 'VisitorBedConfigController@parseCsvImport')->name('visitor-bed-configs.parseCsvImport');
    Route::post('visitor-bed-configs/process-csv-import', 'VisitorBedConfigController@processCsvImport')->name('visitor-bed-configs.processCsvImport');
    Route::resource('visitor-bed-configs', 'VisitorBedConfigController');

    // Staff Levels
    Route::delete('staff-levels/destroy', 'StaffLevelsController@massDestroy')->name('staff-levels.massDestroy');
    Route::post('staff-levels/parse-csv-import', 'StaffLevelsController@parseCsvImport')->name('staff-levels.parseCsvImport');
    Route::post('staff-levels/process-csv-import', 'StaffLevelsController@processCsvImport')->name('staff-levels.processCsvImport');
    Route::resource('staff-levels', 'StaffLevelsController');

    // User Type
    Route::delete('user-types/destroy', 'UserTypeController@massDestroy')->name('user-types.massDestroy');
    Route::post('user-types/parse-csv-import', 'UserTypeController@parseCsvImport')->name('user-types.parseCsvImport');
    Route::post('user-types/process-csv-import', 'UserTypeController@processCsvImport')->name('user-types.processCsvImport');
    Route::resource('user-types', 'UserTypeController');

    // Raw Material Types
    Route::delete('raw-material-types/destroy', 'RawMaterialTypesController@massDestroy')->name('raw-material-types.massDestroy');
    Route::post('raw-material-types/media', 'RawMaterialTypesController@storeMedia')->name('raw-material-types.storeMedia');
    Route::post('raw-material-types/ckmedia', 'RawMaterialTypesController@storeCKEditorImages')->name('raw-material-types.storeCKEditorImages');
    Route::post('raw-material-types/parse-csv-import', 'RawMaterialTypesController@parseCsvImport')->name('raw-material-types.parseCsvImport');
    Route::post('raw-material-types/process-csv-import', 'RawMaterialTypesController@processCsvImport')->name('raw-material-types.processCsvImport');
    Route::resource('raw-material-types', 'RawMaterialTypesController');

    // Yes No Maybe
    Route::delete('yes-no-maybes/destroy', 'YesNoMaybeController@massDestroy')->name('yes-no-maybes.massDestroy');
    Route::post('yes-no-maybes/parse-csv-import', 'YesNoMaybeController@parseCsvImport')->name('yes-no-maybes.parseCsvImport');
    Route::post('yes-no-maybes/process-csv-import', 'YesNoMaybeController@processCsvImport')->name('yes-no-maybes.processCsvImport');
    Route::resource('yes-no-maybes', 'YesNoMaybeController');

    // Material Finish
    Route::delete('material-finishes/destroy', 'MaterialFinishController@massDestroy')->name('material-finishes.massDestroy');
    Route::post('material-finishes/media', 'MaterialFinishController@storeMedia')->name('material-finishes.storeMedia');
    Route::post('material-finishes/ckmedia', 'MaterialFinishController@storeCKEditorImages')->name('material-finishes.storeCKEditorImages');
    Route::post('material-finishes/parse-csv-import', 'MaterialFinishController@parseCsvImport')->name('material-finishes.parseCsvImport');
    Route::post('material-finishes/process-csv-import', 'MaterialFinishController@processCsvImport')->name('material-finishes.processCsvImport');
    Route::resource('material-finishes', 'MaterialFinishController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/media', 'CountriesController@storeMedia')->name('countries.storeMedia');
    Route::post('countries/ckmedia', 'CountriesController@storeCKEditorImages')->name('countries.storeCKEditorImages');
    Route::post('countries/parse-csv-import', 'CountriesController@parseCsvImport')->name('countries.parseCsvImport');
    Route::post('countries/process-csv-import', 'CountriesController@processCsvImport')->name('countries.processCsvImport');
    Route::resource('countries', 'CountriesController');

    // World Regions
    Route::delete('world-regions/destroy', 'WorldRegionsController@massDestroy')->name('world-regions.massDestroy');
    Route::post('world-regions/media', 'WorldRegionsController@storeMedia')->name('world-regions.storeMedia');
    Route::post('world-regions/ckmedia', 'WorldRegionsController@storeCKEditorImages')->name('world-regions.storeCKEditorImages');
    Route::post('world-regions/parse-csv-import', 'WorldRegionsController@parseCsvImport')->name('world-regions.parseCsvImport');
    Route::post('world-regions/process-csv-import', 'WorldRegionsController@processCsvImport')->name('world-regions.processCsvImport');
    Route::resource('world-regions', 'WorldRegionsController');

    // Currencies
    Route::delete('currencies/destroy', 'CurrenciesController@massDestroy')->name('currencies.massDestroy');
    Route::post('currencies/parse-csv-import', 'CurrenciesController@parseCsvImport')->name('currencies.parseCsvImport');
    Route::post('currencies/process-csv-import', 'CurrenciesController@processCsvImport')->name('currencies.processCsvImport');
    Route::resource('currencies', 'CurrenciesController');

    // Languages
    Route::delete('languages/destroy', 'LanguagesController@massDestroy')->name('languages.massDestroy');
    Route::post('languages/parse-csv-import', 'LanguagesController@parseCsvImport')->name('languages.parseCsvImport');
    Route::post('languages/process-csv-import', 'LanguagesController@processCsvImport')->name('languages.processCsvImport');
    Route::resource('languages', 'LanguagesController');

    // Currency Rates
    Route::delete('currency-rates/destroy', 'CurrencyRatesController@massDestroy')->name('currency-rates.massDestroy');
    Route::post('currency-rates/parse-csv-import', 'CurrencyRatesController@parseCsvImport')->name('currency-rates.parseCsvImport');
    Route::post('currency-rates/process-csv-import', 'CurrencyRatesController@processCsvImport')->name('currency-rates.processCsvImport');
    Route::resource('currency-rates', 'CurrencyRatesController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::post('user-alerts/parse-csv-import', 'UserAlertsController@parseCsvImport')->name('user-alerts.parseCsvImport');
    Route::post('user-alerts/process-csv-import', 'UserAlertsController@processCsvImport')->name('user-alerts.processCsvImport');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::post('expense-categories/parse-csv-import', 'ExpenseCategoryController@parseCsvImport')->name('expense-categories.parseCsvImport');
    Route::post('expense-categories/process-csv-import', 'ExpenseCategoryController@processCsvImport')->name('expense-categories.processCsvImport');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::post('income-categories/parse-csv-import', 'IncomeCategoryController@parseCsvImport')->name('income-categories.parseCsvImport');
    Route::post('income-categories/process-csv-import', 'IncomeCategoryController@processCsvImport')->name('income-categories.processCsvImport');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::post('incomes/parse-csv-import', 'IncomeController@parseCsvImport')->name('incomes.parseCsvImport');
    Route::post('incomes/process-csv-import', 'IncomeController@processCsvImport')->name('incomes.processCsvImport');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::post('faq-categories/parse-csv-import', 'FaqCategoryController@parseCsvImport')->name('faq-categories.parseCsvImport');
    Route::post('faq-categories/process-csv-import', 'FaqCategoryController@processCsvImport')->name('faq-categories.processCsvImport');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/parse-csv-import', 'FaqQuestionController@parseCsvImport')->name('faq-questions.parseCsvImport');
    Route::post('faq-questions/process-csv-import', 'FaqQuestionController@processCsvImport')->name('faq-questions.processCsvImport');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/media', 'ContactContactsController@storeMedia')->name('contact-contacts.storeMedia');
    Route::post('contact-contacts/ckmedia', 'ContactContactsController@storeCKEditorImages')->name('contact-contacts.storeCKEditorImages');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Company Types
    Route::delete('company-types/destroy', 'CompanyTypesController@massDestroy')->name('company-types.massDestroy');
    Route::post('company-types/media', 'CompanyTypesController@storeMedia')->name('company-types.storeMedia');
    Route::post('company-types/ckmedia', 'CompanyTypesController@storeCKEditorImages')->name('company-types.storeCKEditorImages');
    Route::post('company-types/parse-csv-import', 'CompanyTypesController@parseCsvImport')->name('company-types.parseCsvImport');
    Route::post('company-types/process-csv-import', 'CompanyTypesController@processCsvImport')->name('company-types.processCsvImport');
    Route::resource('company-types', 'CompanyTypesController');

    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductsController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductsController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductsController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductsController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductsController');

    // Raw Material
    Route::delete('raw-materials/destroy', 'RawMaterialController@massDestroy')->name('raw-materials.massDestroy');
    Route::post('raw-materials/media', 'RawMaterialController@storeMedia')->name('raw-materials.storeMedia');
    Route::post('raw-materials/ckmedia', 'RawMaterialController@storeCKEditorImages')->name('raw-materials.storeCKEditorImages');
    Route::post('raw-materials/parse-csv-import', 'RawMaterialController@parseCsvImport')->name('raw-materials.parseCsvImport');
    Route::post('raw-materials/process-csv-import', 'RawMaterialController@processCsvImport')->name('raw-materials.processCsvImport');
    Route::resource('raw-materials', 'RawMaterialController');

    // Product Nicknames
    Route::delete('product-nicknames/destroy', 'ProductNicknamesController@massDestroy')->name('product-nicknames.massDestroy');
    Route::post('product-nicknames/media', 'ProductNicknamesController@storeMedia')->name('product-nicknames.storeMedia');
    Route::post('product-nicknames/ckmedia', 'ProductNicknamesController@storeCKEditorImages')->name('product-nicknames.storeCKEditorImages');
    Route::post('product-nicknames/parse-csv-import', 'ProductNicknamesController@parseCsvImport')->name('product-nicknames.parseCsvImport');
    Route::post('product-nicknames/process-csv-import', 'ProductNicknamesController@processCsvImport')->name('product-nicknames.processCsvImport');
    Route::resource('product-nicknames', 'ProductNicknamesController');

    // Company Ownership Types
    Route::delete('company-ownership-types/destroy', 'CompanyOwnershipTypesController@massDestroy')->name('company-ownership-types.massDestroy');
    Route::post('company-ownership-types/parse-csv-import', 'CompanyOwnershipTypesController@parseCsvImport')->name('company-ownership-types.parseCsvImport');
    Route::post('company-ownership-types/process-csv-import', 'CompanyOwnershipTypesController@processCsvImport')->name('company-ownership-types.processCsvImport');
    Route::resource('company-ownership-types', 'CompanyOwnershipTypesController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/parse-csv-import', 'OrdersController@parseCsvImport')->name('orders.parseCsvImport');
    Route::post('orders/process-csv-import', 'OrdersController@processCsvImport')->name('orders.processCsvImport');
    Route::resource('orders', 'OrdersController');

    // Addresses
    Route::delete('addresses/destroy', 'AddressesController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/parse-csv-import', 'AddressesController@parseCsvImport')->name('addresses.parseCsvImport');
    Route::post('addresses/process-csv-import', 'AddressesController@processCsvImport')->name('addresses.processCsvImport');
    Route::resource('addresses', 'AddressesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/media', 'ProvincesController@storeMedia')->name('provinces.storeMedia');
    Route::post('provinces/ckmedia', 'ProvincesController@storeCKEditorImages')->name('provinces.storeCKEditorImages');
    Route::post('provinces/parse-csv-import', 'ProvincesController@parseCsvImport')->name('provinces.parseCsvImport');
    Route::post('provinces/process-csv-import', 'ProvincesController@processCsvImport')->name('provinces.processCsvImport');
    Route::resource('provinces', 'ProvincesController');

    // Afa Staff
    Route::delete('afa-staffs/destroy', 'AfaStaffController@massDestroy')->name('afa-staffs.massDestroy');
    Route::post('afa-staffs/parse-csv-import', 'AfaStaffController@parseCsvImport')->name('afa-staffs.parseCsvImport');
    Route::post('afa-staffs/process-csv-import', 'AfaStaffController@processCsvImport')->name('afa-staffs.processCsvImport');
    Route::resource('afa-staffs', 'AfaStaffController');

    // Product Sku
    Route::delete('product-skus/destroy', 'ProductSkuController@massDestroy')->name('product-skus.massDestroy');
    Route::post('product-skus/parse-csv-import', 'ProductSkuController@parseCsvImport')->name('product-skus.parseCsvImport');
    Route::post('product-skus/process-csv-import', 'ProductSkuController@processCsvImport')->name('product-skus.processCsvImport');
    Route::resource('product-skus', 'ProductSkuController');

    // Order Items
    Route::delete('order-items/destroy', 'OrderItemsController@massDestroy')->name('order-items.massDestroy');
    Route::post('order-items/parse-csv-import', 'OrderItemsController@parseCsvImport')->name('order-items.parseCsvImport');
    Route::post('order-items/process-csv-import', 'OrderItemsController@processCsvImport')->name('order-items.processCsvImport');
    Route::resource('order-items', 'OrderItemsController');

    // Drawer Movement
    Route::delete('drawer-movements/destroy', 'DrawerMovementController@massDestroy')->name('drawer-movements.massDestroy');
    Route::post('drawer-movements/parse-csv-import', 'DrawerMovementController@parseCsvImport')->name('drawer-movements.parseCsvImport');
    Route::post('drawer-movements/process-csv-import', 'DrawerMovementController@processCsvImport')->name('drawer-movements.processCsvImport');
    Route::resource('drawer-movements', 'DrawerMovementController');

    // Shipping Containers
    Route::delete('shipping-containers/destroy', 'ShippingContainersController@massDestroy')->name('shipping-containers.massDestroy');
    Route::post('shipping-containers/parse-csv-import', 'ShippingContainersController@parseCsvImport')->name('shipping-containers.parseCsvImport');
    Route::post('shipping-containers/process-csv-import', 'ShippingContainersController@processCsvImport')->name('shipping-containers.processCsvImport');
    Route::resource('shipping-containers', 'ShippingContainersController');

    // Order Status
    Route::delete('order-statuses/destroy', 'OrderStatusController@massDestroy')->name('order-statuses.massDestroy');
    Route::post('order-statuses/parse-csv-import', 'OrderStatusController@parseCsvImport')->name('order-statuses.parseCsvImport');
    Route::post('order-statuses/process-csv-import', 'OrderStatusController@processCsvImport')->name('order-statuses.processCsvImport');
    Route::resource('order-statuses', 'OrderStatusController');

    // Price List Types
    Route::delete('price-list-types/destroy', 'PriceListTypesController@massDestroy')->name('price-list-types.massDestroy');
    Route::post('price-list-types/parse-csv-import', 'PriceListTypesController@parseCsvImport')->name('price-list-types.parseCsvImport');
    Route::post('price-list-types/process-csv-import', 'PriceListTypesController@processCsvImport')->name('price-list-types.processCsvImport');
    Route::resource('price-list-types', 'PriceListTypesController');

    // Base Styles
    Route::delete('base-styles/destroy', 'BaseStylesController@massDestroy')->name('base-styles.massDestroy');
    Route::post('base-styles/parse-csv-import', 'BaseStylesController@parseCsvImport')->name('base-styles.parseCsvImport');
    Route::post('base-styles/process-csv-import', 'BaseStylesController@processCsvImport')->name('base-styles.processCsvImport');
    Route::resource('base-styles', 'BaseStylesController');

    // Order Roles
    Route::delete('order-roles/destroy', 'OrderRolesController@massDestroy')->name('order-roles.massDestroy');
    Route::post('order-roles/parse-csv-import', 'OrderRolesController@parseCsvImport')->name('order-roles.parseCsvImport');
    Route::post('order-roles/process-csv-import', 'OrderRolesController@processCsvImport')->name('order-roles.processCsvImport');
    Route::resource('order-roles', 'OrderRolesController');

    // Complaint Status
    Route::delete('complaint-statuses/destroy', 'ComplaintStatusController@massDestroy')->name('complaint-statuses.massDestroy');
    Route::post('complaint-statuses/parse-csv-import', 'ComplaintStatusController@parseCsvImport')->name('complaint-statuses.parseCsvImport');
    Route::post('complaint-statuses/process-csv-import', 'ComplaintStatusController@processCsvImport')->name('complaint-statuses.processCsvImport');
    Route::resource('complaint-statuses', 'ComplaintStatusController');

    // Price List Groups
    Route::delete('price-list-groups/destroy', 'PriceListGroupsController@massDestroy')->name('price-list-groups.massDestroy');
    Route::post('price-list-groups/parse-csv-import', 'PriceListGroupsController@parseCsvImport')->name('price-list-groups.parseCsvImport');
    Route::post('price-list-groups/process-csv-import', 'PriceListGroupsController@processCsvImport')->name('price-list-groups.processCsvImport');
    Route::resource('price-list-groups', 'PriceListGroupsController');

    // Company Roles
    Route::delete('company-roles/destroy', 'CompanyRolesController@massDestroy')->name('company-roles.massDestroy');
    Route::post('company-roles/parse-csv-import', 'CompanyRolesController@parseCsvImport')->name('company-roles.parseCsvImport');
    Route::post('company-roles/process-csv-import', 'CompanyRolesController@processCsvImport')->name('company-roles.processCsvImport');
    Route::resource('company-roles', 'CompanyRolesController');

    // Component Part Names
    Route::delete('component-part-names/destroy', 'ComponentPartNamesController@massDestroy')->name('component-part-names.massDestroy');
    Route::post('component-part-names/media', 'ComponentPartNamesController@storeMedia')->name('component-part-names.storeMedia');
    Route::post('component-part-names/ckmedia', 'ComponentPartNamesController@storeCKEditorImages')->name('component-part-names.storeCKEditorImages');
    Route::post('component-part-names/parse-csv-import', 'ComponentPartNamesController@parseCsvImport')->name('component-part-names.parseCsvImport');
    Route::post('component-part-names/process-csv-import', 'ComponentPartNamesController@processCsvImport')->name('component-part-names.processCsvImport');
    Route::resource('component-part-names', 'ComponentPartNamesController');

    // Product Size Names
    Route::delete('product-size-names/destroy', 'ProductSizeNamesController@massDestroy')->name('product-size-names.massDestroy');
    Route::post('product-size-names/parse-csv-import', 'ProductSizeNamesController@parseCsvImport')->name('product-size-names.parseCsvImport');
    Route::post('product-size-names/process-csv-import', 'ProductSizeNamesController@processCsvImport')->name('product-size-names.processCsvImport');
    Route::resource('product-size-names', 'ProductSizeNamesController');

    // Equipment Type
    Route::delete('equipment-types/destroy', 'EquipmentTypeController@massDestroy')->name('equipment-types.massDestroy');
    Route::post('equipment-types/parse-csv-import', 'EquipmentTypeController@parseCsvImport')->name('equipment-types.parseCsvImport');
    Route::post('equipment-types/process-csv-import', 'EquipmentTypeController@processCsvImport')->name('equipment-types.processCsvImport');
    Route::resource('equipment-types', 'EquipmentTypeController');

    // Equipment
    Route::delete('equipment/destroy', 'EquipmentController@massDestroy')->name('equipment.massDestroy');
    Route::post('equipment/media', 'EquipmentController@storeMedia')->name('equipment.storeMedia');
    Route::post('equipment/ckmedia', 'EquipmentController@storeCKEditorImages')->name('equipment.storeCKEditorImages');
    Route::post('equipment/parse-csv-import', 'EquipmentController@parseCsvImport')->name('equipment.parseCsvImport');
    Route::post('equipment/process-csv-import', 'EquipmentController@processCsvImport')->name('equipment.processCsvImport');
    Route::resource('equipment', 'EquipmentController');

    // Equipment Audit
    Route::delete('equipment-audits/destroy', 'EquipmentAuditController@massDestroy')->name('equipment-audits.massDestroy');
    Route::post('equipment-audits/parse-csv-import', 'EquipmentAuditController@parseCsvImport')->name('equipment-audits.parseCsvImport');
    Route::post('equipment-audits/process-csv-import', 'EquipmentAuditController@processCsvImport')->name('equipment-audits.processCsvImport');
    Route::resource('equipment-audits', 'EquipmentAuditController');

    // Document Types
    Route::delete('document-types/destroy', 'DocumentTypesController@massDestroy')->name('document-types.massDestroy');
    Route::post('document-types/parse-csv-import', 'DocumentTypesController@parseCsvImport')->name('document-types.parseCsvImport');
    Route::post('document-types/process-csv-import', 'DocumentTypesController@processCsvImport')->name('document-types.processCsvImport');
    Route::resource('document-types', 'DocumentTypesController');

    // File Types
    Route::delete('file-types/destroy', 'FileTypesController@massDestroy')->name('file-types.massDestroy');
    Route::post('file-types/parse-csv-import', 'FileTypesController@parseCsvImport')->name('file-types.parseCsvImport');
    Route::post('file-types/process-csv-import', 'FileTypesController@processCsvImport')->name('file-types.processCsvImport');
    Route::resource('file-types', 'FileTypesController');

    // Documents
    Route::delete('documents/destroy', 'DocumentsController@massDestroy')->name('documents.massDestroy');
    Route::resource('documents', 'DocumentsController');

    // Price Lists
    Route::delete('price-lists/destroy', 'PriceListsController@massDestroy')->name('price-lists.massDestroy');
    Route::post('price-lists/parse-csv-import', 'PriceListsController@parseCsvImport')->name('price-lists.parseCsvImport');
    Route::post('price-lists/process-csv-import', 'PriceListsController@processCsvImport')->name('price-lists.processCsvImport');
    Route::resource('price-lists', 'PriceListsController');

    // Product Code Groups
    Route::delete('product-code-groups/destroy', 'ProductCodeGroupsController@massDestroy')->name('product-code-groups.massDestroy');
    Route::post('product-code-groups/parse-csv-import', 'ProductCodeGroupsController@parseCsvImport')->name('product-code-groups.parseCsvImport');
    Route::post('product-code-groups/process-csv-import', 'ProductCodeGroupsController@processCsvImport')->name('product-code-groups.processCsvImport');
    Route::resource('product-code-groups', 'ProductCodeGroupsController');

    // Product Functions
    Route::delete('product-functions/destroy', 'ProductFunctionsController@massDestroy')->name('product-functions.massDestroy');
    Route::post('product-functions/parse-csv-import', 'ProductFunctionsController@parseCsvImport')->name('product-functions.parseCsvImport');
    Route::post('product-functions/process-csv-import', 'ProductFunctionsController@processCsvImport')->name('product-functions.processCsvImport');
    Route::resource('product-functions', 'ProductFunctionsController');

    // Product Development Stages
    Route::delete('product-development-stages/destroy', 'ProductDevelopmentStagesController@massDestroy')->name('product-development-stages.massDestroy');
    Route::post('product-development-stages/parse-csv-import', 'ProductDevelopmentStagesController@parseCsvImport')->name('product-development-stages.parseCsvImport');
    Route::post('product-development-stages/process-csv-import', 'ProductDevelopmentStagesController@processCsvImport')->name('product-development-stages.processCsvImport');
    Route::resource('product-development-stages', 'ProductDevelopmentStagesController');

    // Packaging Types
    Route::delete('packaging-types/destroy', 'PackagingTypesController@massDestroy')->name('packaging-types.massDestroy');
    Route::post('packaging-types/media', 'PackagingTypesController@storeMedia')->name('packaging-types.storeMedia');
    Route::post('packaging-types/ckmedia', 'PackagingTypesController@storeCKEditorImages')->name('packaging-types.storeCKEditorImages');
    Route::post('packaging-types/parse-csv-import', 'PackagingTypesController@parseCsvImport')->name('packaging-types.parseCsvImport');
    Route::post('packaging-types/process-csv-import', 'PackagingTypesController@processCsvImport')->name('packaging-types.processCsvImport');
    Route::resource('packaging-types', 'PackagingTypesController');

    // Packaging
    Route::delete('packagings/destroy', 'PackagingController@massDestroy')->name('packagings.massDestroy');
    Route::resource('packagings', 'PackagingController');

    // Prices
    Route::delete('prices/destroy', 'PricesController@massDestroy')->name('prices.massDestroy');
    Route::post('prices/parse-csv-import', 'PricesController@parseCsvImport')->name('prices.parseCsvImport');
    Route::post('prices/process-csv-import', 'PricesController@processCsvImport')->name('prices.processCsvImport');
    Route::resource('prices', 'PricesController');

    // Fabric Groups
    Route::delete('fabric-groups/destroy', 'FabricGroupsController@massDestroy')->name('fabric-groups.massDestroy');
    Route::post('fabric-groups/media', 'FabricGroupsController@storeMedia')->name('fabric-groups.storeMedia');
    Route::post('fabric-groups/ckmedia', 'FabricGroupsController@storeCKEditorImages')->name('fabric-groups.storeCKEditorImages');
    Route::post('fabric-groups/parse-csv-import', 'FabricGroupsController@parseCsvImport')->name('fabric-groups.parseCsvImport');
    Route::post('fabric-groups/process-csv-import', 'FabricGroupsController@processCsvImport')->name('fabric-groups.processCsvImport');
    Route::resource('fabric-groups', 'FabricGroupsController');

    // Departments
    Route::delete('departments/destroy', 'DepartmentsController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/media', 'DepartmentsController@storeMedia')->name('departments.storeMedia');
    Route::post('departments/ckmedia', 'DepartmentsController@storeCKEditorImages')->name('departments.storeCKEditorImages');
    Route::post('departments/parse-csv-import', 'DepartmentsController@parseCsvImport')->name('departments.parseCsvImport');
    Route::post('departments/process-csv-import', 'DepartmentsController@processCsvImport')->name('departments.processCsvImport');
    Route::resource('departments', 'DepartmentsController');

    // Bank Accounts
    Route::delete('bank-accounts/destroy', 'BankAccountsController@massDestroy')->name('bank-accounts.massDestroy');
    Route::post('bank-accounts/parse-csv-import', 'BankAccountsController@parseCsvImport')->name('bank-accounts.parseCsvImport');
    Route::post('bank-accounts/process-csv-import', 'BankAccountsController@processCsvImport')->name('bank-accounts.processCsvImport');
    Route::resource('bank-accounts', 'BankAccountsController');

    // Fabric
    Route::delete('fabrics/destroy', 'FabricController@massDestroy')->name('fabrics.massDestroy');
    Route::post('fabrics/parse-csv-import', 'FabricController@parseCsvImport')->name('fabrics.parseCsvImport');
    Route::post('fabrics/process-csv-import', 'FabricController@processCsvImport')->name('fabrics.processCsvImport');
    Route::resource('fabrics', 'FabricController');

    // Fabric Price Bands
    Route::delete('fabric-price-bands/destroy', 'FabricPriceBandsController@massDestroy')->name('fabric-price-bands.massDestroy');
    Route::post('fabric-price-bands/media', 'FabricPriceBandsController@storeMedia')->name('fabric-price-bands.storeMedia');
    Route::post('fabric-price-bands/ckmedia', 'FabricPriceBandsController@storeCKEditorImages')->name('fabric-price-bands.storeCKEditorImages');
    Route::post('fabric-price-bands/parse-csv-import', 'FabricPriceBandsController@parseCsvImport')->name('fabric-price-bands.parseCsvImport');
    Route::post('fabric-price-bands/process-csv-import', 'FabricPriceBandsController@processCsvImport')->name('fabric-price-bands.processCsvImport');
    Route::resource('fabric-price-bands', 'FabricPriceBandsController');

    // Fabric Nicknames
    Route::delete('fabric-nicknames/destroy', 'FabricNicknamesController@massDestroy')->name('fabric-nicknames.massDestroy');
    Route::post('fabric-nicknames/parse-csv-import', 'FabricNicknamesController@parseCsvImport')->name('fabric-nicknames.parseCsvImport');
    Route::post('fabric-nicknames/process-csv-import', 'FabricNicknamesController@processCsvImport')->name('fabric-nicknames.processCsvImport');
    Route::resource('fabric-nicknames', 'FabricNicknamesController');

    // Product Groups
    Route::delete('product-groups/destroy', 'ProductGroupsController@massDestroy')->name('product-groups.massDestroy');
    Route::post('product-groups/media', 'ProductGroupsController@storeMedia')->name('product-groups.storeMedia');
    Route::post('product-groups/ckmedia', 'ProductGroupsController@storeCKEditorImages')->name('product-groups.storeCKEditorImages');
    Route::post('product-groups/parse-csv-import', 'ProductGroupsController@parseCsvImport')->name('product-groups.parseCsvImport');
    Route::post('product-groups/process-csv-import', 'ProductGroupsController@processCsvImport')->name('product-groups.processCsvImport');
    Route::resource('product-groups', 'ProductGroupsController');

    // Bed Sizes By Region
    Route::delete('bed-sizes-by-regions/destroy', 'BedSizesByRegionController@massDestroy')->name('bed-sizes-by-regions.massDestroy');
    Route::post('bed-sizes-by-regions/parse-csv-import', 'BedSizesByRegionController@parseCsvImport')->name('bed-sizes-by-regions.parseCsvImport');
    Route::post('bed-sizes-by-regions/process-csv-import', 'BedSizesByRegionController@processCsvImport')->name('bed-sizes-by-regions.processCsvImport');
    Route::resource('bed-sizes-by-regions', 'BedSizesByRegionController');

    // Bed Size Groups
    Route::delete('bed-size-groups/destroy', 'BedSizeGroupsController@massDestroy')->name('bed-size-groups.massDestroy');
    Route::post('bed-size-groups/media', 'BedSizeGroupsController@storeMedia')->name('bed-size-groups.storeMedia');
    Route::post('bed-size-groups/ckmedia', 'BedSizeGroupsController@storeCKEditorImages')->name('bed-size-groups.storeCKEditorImages');
    Route::post('bed-size-groups/parse-csv-import', 'BedSizeGroupsController@parseCsvImport')->name('bed-size-groups.parseCsvImport');
    Route::post('bed-size-groups/process-csv-import', 'BedSizeGroupsController@processCsvImport')->name('bed-size-groups.processCsvImport');
    Route::resource('bed-size-groups', 'BedSizeGroupsController');

    // Inspections
    Route::delete('inspections/destroy', 'InspectionsController@massDestroy')->name('inspections.massDestroy');
    Route::post('inspections/parse-csv-import', 'InspectionsController@parseCsvImport')->name('inspections.parseCsvImport');
    Route::post('inspections/process-csv-import', 'InspectionsController@processCsvImport')->name('inspections.processCsvImport');
    Route::resource('inspections', 'InspectionsController');

    // Ordertype
    Route::delete('ordertypes/destroy', 'OrdertypeController@massDestroy')->name('ordertypes.massDestroy');
    Route::post('ordertypes/parse-csv-import', 'OrdertypeController@parseCsvImport')->name('ordertypes.parseCsvImport');
    Route::post('ordertypes/process-csv-import', 'OrdertypeController@processCsvImport')->name('ordertypes.processCsvImport');
    Route::resource('ordertypes', 'OrdertypeController');

    // Product Type
    Route::delete('product-types/destroy', 'ProductTypeController@massDestroy')->name('product-types.massDestroy');
    Route::post('product-types/parse-csv-import', 'ProductTypeController@parseCsvImport')->name('product-types.parseCsvImport');
    Route::post('product-types/process-csv-import', 'ProductTypeController@processCsvImport')->name('product-types.processCsvImport');
    Route::resource('product-types', 'ProductTypeController');

    // Product Sku Letters
    Route::delete('product-sku-letters/destroy', 'ProductSkuLettersController@massDestroy')->name('product-sku-letters.massDestroy');
    Route::post('product-sku-letters/parse-csv-import', 'ProductSkuLettersController@parseCsvImport')->name('product-sku-letters.parseCsvImport');
    Route::post('product-sku-letters/process-csv-import', 'ProductSkuLettersController@processCsvImport')->name('product-sku-letters.processCsvImport');
    Route::resource('product-sku-letters', 'ProductSkuLettersController');

    // Component Parts
    Route::delete('component-parts/destroy', 'ComponentPartsController@massDestroy')->name('component-parts.massDestroy');
    Route::post('component-parts/parse-csv-import', 'ComponentPartsController@parseCsvImport')->name('component-parts.parseCsvImport');
    Route::post('component-parts/process-csv-import', 'ComponentPartsController@processCsvImport')->name('component-parts.processCsvImport');
    Route::resource('component-parts', 'ComponentPartsController');

    // Supplier Audit
    Route::delete('supplier-audits/destroy', 'SupplierAuditController@massDestroy')->name('supplier-audits.massDestroy');
    Route::post('supplier-audits/parse-csv-import', 'SupplierAuditController@parseCsvImport')->name('supplier-audits.parseCsvImport');
    Route::post('supplier-audits/process-csv-import', 'SupplierAuditController@processCsvImport')->name('supplier-audits.processCsvImport');
    Route::resource('supplier-audits', 'SupplierAuditController');

    // Inspection Status
    Route::delete('inspection-statuses/destroy', 'InspectionStatusController@massDestroy')->name('inspection-statuses.massDestroy');
    Route::resource('inspection-statuses', 'InspectionStatusController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Complaints
    Route::delete('complaints/destroy', 'ComplaintsController@massDestroy')->name('complaints.massDestroy');
    Route::resource('complaints', 'ComplaintsController');

    // Storage Options
    Route::delete('storage-options/destroy', 'StorageOptionsController@massDestroy')->name('storage-options.massDestroy');
    Route::post('storage-options/media', 'StorageOptionsController@storeMedia')->name('storage-options.storeMedia');
    Route::post('storage-options/ckmedia', 'StorageOptionsController@storeCKEditorImages')->name('storage-options.storeCKEditorImages');
    Route::resource('storage-options', 'StorageOptionsController');

    // Product Collections
    Route::delete('product-collections/destroy', 'ProductCollectionsController@massDestroy')->name('product-collections.massDestroy');
    Route::resource('product-collections', 'ProductCollectionsController');

    // Gas Lift Config
    Route::delete('gas-lift-configs/destroy', 'GasLiftConfigController@massDestroy')->name('gas-lift-configs.massDestroy');
    Route::post('gas-lift-configs/media', 'GasLiftConfigController@storeMedia')->name('gas-lift-configs.storeMedia');
    Route::post('gas-lift-configs/ckmedia', 'GasLiftConfigController@storeCKEditorImages')->name('gas-lift-configs.storeCKEditorImages');
    Route::resource('gas-lift-configs', 'GasLiftConfigController');

    // Tv Bed Config
    Route::delete('tv-bed-configs/destroy', 'TvBedConfigController@massDestroy')->name('tv-bed-configs.massDestroy');
    Route::post('tv-bed-configs/media', 'TvBedConfigController@storeMedia')->name('tv-bed-configs.storeMedia');
    Route::post('tv-bed-configs/ckmedia', 'TvBedConfigController@storeCKEditorImages')->name('tv-bed-configs.storeCKEditorImages');
    Route::resource('tv-bed-configs', 'TvBedConfigController');

    // Drawer Config
    Route::delete('drawer-configs/destroy', 'DrawerConfigController@massDestroy')->name('drawer-configs.massDestroy');
    Route::post('drawer-configs/media', 'DrawerConfigController@storeMedia')->name('drawer-configs.storeMedia');
    Route::post('drawer-configs/ckmedia', 'DrawerConfigController@storeCKEditorImages')->name('drawer-configs.storeCKEditorImages');
    Route::resource('drawer-configs', 'DrawerConfigController');

    // Visitor Bed Config
    Route::delete('visitor-bed-configs/destroy', 'VisitorBedConfigController@massDestroy')->name('visitor-bed-configs.massDestroy');
    Route::post('visitor-bed-configs/media', 'VisitorBedConfigController@storeMedia')->name('visitor-bed-configs.storeMedia');
    Route::post('visitor-bed-configs/ckmedia', 'VisitorBedConfigController@storeCKEditorImages')->name('visitor-bed-configs.storeCKEditorImages');
    Route::resource('visitor-bed-configs', 'VisitorBedConfigController');

    // Staff Levels
    Route::delete('staff-levels/destroy', 'StaffLevelsController@massDestroy')->name('staff-levels.massDestroy');
    Route::resource('staff-levels', 'StaffLevelsController');

    // User Type
    Route::delete('user-types/destroy', 'UserTypeController@massDestroy')->name('user-types.massDestroy');
    Route::resource('user-types', 'UserTypeController');

    // Raw Material Types
    Route::delete('raw-material-types/destroy', 'RawMaterialTypesController@massDestroy')->name('raw-material-types.massDestroy');
    Route::post('raw-material-types/media', 'RawMaterialTypesController@storeMedia')->name('raw-material-types.storeMedia');
    Route::post('raw-material-types/ckmedia', 'RawMaterialTypesController@storeCKEditorImages')->name('raw-material-types.storeCKEditorImages');
    Route::resource('raw-material-types', 'RawMaterialTypesController');

    // Yes No Maybe
    Route::delete('yes-no-maybes/destroy', 'YesNoMaybeController@massDestroy')->name('yes-no-maybes.massDestroy');
    Route::resource('yes-no-maybes', 'YesNoMaybeController');

    // Material Finish
    Route::delete('material-finishes/destroy', 'MaterialFinishController@massDestroy')->name('material-finishes.massDestroy');
    Route::post('material-finishes/media', 'MaterialFinishController@storeMedia')->name('material-finishes.storeMedia');
    Route::post('material-finishes/ckmedia', 'MaterialFinishController@storeCKEditorImages')->name('material-finishes.storeCKEditorImages');
    Route::resource('material-finishes', 'MaterialFinishController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/media', 'CountriesController@storeMedia')->name('countries.storeMedia');
    Route::post('countries/ckmedia', 'CountriesController@storeCKEditorImages')->name('countries.storeCKEditorImages');
    Route::resource('countries', 'CountriesController');

    // World Regions
    Route::delete('world-regions/destroy', 'WorldRegionsController@massDestroy')->name('world-regions.massDestroy');
    Route::post('world-regions/media', 'WorldRegionsController@storeMedia')->name('world-regions.storeMedia');
    Route::post('world-regions/ckmedia', 'WorldRegionsController@storeCKEditorImages')->name('world-regions.storeCKEditorImages');
    Route::resource('world-regions', 'WorldRegionsController');

    // Currencies
    Route::delete('currencies/destroy', 'CurrenciesController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrenciesController');

    // Languages
    Route::delete('languages/destroy', 'LanguagesController@massDestroy')->name('languages.massDestroy');
    Route::resource('languages', 'LanguagesController');

    // Currency Rates
    Route::delete('currency-rates/destroy', 'CurrencyRatesController@massDestroy')->name('currency-rates.massDestroy');
    Route::resource('currency-rates', 'CurrencyRatesController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/media', 'ContactContactsController@storeMedia')->name('contact-contacts.storeMedia');
    Route::post('contact-contacts/ckmedia', 'ContactContactsController@storeCKEditorImages')->name('contact-contacts.storeCKEditorImages');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Company Types
    Route::delete('company-types/destroy', 'CompanyTypesController@massDestroy')->name('company-types.massDestroy');
    Route::post('company-types/media', 'CompanyTypesController@storeMedia')->name('company-types.storeMedia');
    Route::post('company-types/ckmedia', 'CompanyTypesController@storeCKEditorImages')->name('company-types.storeCKEditorImages');
    Route::resource('company-types', 'CompanyTypesController');

    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductsController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductsController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductsController');

    // Raw Material
    Route::delete('raw-materials/destroy', 'RawMaterialController@massDestroy')->name('raw-materials.massDestroy');
    Route::post('raw-materials/media', 'RawMaterialController@storeMedia')->name('raw-materials.storeMedia');
    Route::post('raw-materials/ckmedia', 'RawMaterialController@storeCKEditorImages')->name('raw-materials.storeCKEditorImages');
    Route::resource('raw-materials', 'RawMaterialController');

    // Product Nicknames
    Route::delete('product-nicknames/destroy', 'ProductNicknamesController@massDestroy')->name('product-nicknames.massDestroy');
    Route::post('product-nicknames/media', 'ProductNicknamesController@storeMedia')->name('product-nicknames.storeMedia');
    Route::post('product-nicknames/ckmedia', 'ProductNicknamesController@storeCKEditorImages')->name('product-nicknames.storeCKEditorImages');
    Route::resource('product-nicknames', 'ProductNicknamesController');

    // Company Ownership Types
    Route::delete('company-ownership-types/destroy', 'CompanyOwnershipTypesController@massDestroy')->name('company-ownership-types.massDestroy');
    Route::resource('company-ownership-types', 'CompanyOwnershipTypesController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrdersController');

    // Addresses
    Route::delete('addresses/destroy', 'AddressesController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressesController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::post('provinces/media', 'ProvincesController@storeMedia')->name('provinces.storeMedia');
    Route::post('provinces/ckmedia', 'ProvincesController@storeCKEditorImages')->name('provinces.storeCKEditorImages');
    Route::resource('provinces', 'ProvincesController');

    // Afa Staff
    Route::delete('afa-staffs/destroy', 'AfaStaffController@massDestroy')->name('afa-staffs.massDestroy');
    Route::resource('afa-staffs', 'AfaStaffController');

    // Product Sku
    Route::delete('product-skus/destroy', 'ProductSkuController@massDestroy')->name('product-skus.massDestroy');
    Route::resource('product-skus', 'ProductSkuController');

    // Order Items
    Route::delete('order-items/destroy', 'OrderItemsController@massDestroy')->name('order-items.massDestroy');
    Route::resource('order-items', 'OrderItemsController');

    // Drawer Movement
    Route::delete('drawer-movements/destroy', 'DrawerMovementController@massDestroy')->name('drawer-movements.massDestroy');
    Route::resource('drawer-movements', 'DrawerMovementController');

    // Shipping Containers
    Route::delete('shipping-containers/destroy', 'ShippingContainersController@massDestroy')->name('shipping-containers.massDestroy');
    Route::resource('shipping-containers', 'ShippingContainersController');

    // Order Status
    Route::delete('order-statuses/destroy', 'OrderStatusController@massDestroy')->name('order-statuses.massDestroy');
    Route::resource('order-statuses', 'OrderStatusController');

    // Price List Types
    Route::delete('price-list-types/destroy', 'PriceListTypesController@massDestroy')->name('price-list-types.massDestroy');
    Route::resource('price-list-types', 'PriceListTypesController');

    // Base Styles
    Route::delete('base-styles/destroy', 'BaseStylesController@massDestroy')->name('base-styles.massDestroy');
    Route::resource('base-styles', 'BaseStylesController');

    // Order Roles
    Route::delete('order-roles/destroy', 'OrderRolesController@massDestroy')->name('order-roles.massDestroy');
    Route::resource('order-roles', 'OrderRolesController');

    // Complaint Status
    Route::delete('complaint-statuses/destroy', 'ComplaintStatusController@massDestroy')->name('complaint-statuses.massDestroy');
    Route::resource('complaint-statuses', 'ComplaintStatusController');

    // Price List Groups
    Route::delete('price-list-groups/destroy', 'PriceListGroupsController@massDestroy')->name('price-list-groups.massDestroy');
    Route::resource('price-list-groups', 'PriceListGroupsController');

    // Company Roles
    Route::delete('company-roles/destroy', 'CompanyRolesController@massDestroy')->name('company-roles.massDestroy');
    Route::resource('company-roles', 'CompanyRolesController');

    // Component Part Names
    Route::delete('component-part-names/destroy', 'ComponentPartNamesController@massDestroy')->name('component-part-names.massDestroy');
    Route::post('component-part-names/media', 'ComponentPartNamesController@storeMedia')->name('component-part-names.storeMedia');
    Route::post('component-part-names/ckmedia', 'ComponentPartNamesController@storeCKEditorImages')->name('component-part-names.storeCKEditorImages');
    Route::resource('component-part-names', 'ComponentPartNamesController');

    // Product Size Names
    Route::delete('product-size-names/destroy', 'ProductSizeNamesController@massDestroy')->name('product-size-names.massDestroy');
    Route::resource('product-size-names', 'ProductSizeNamesController');

    // Equipment Type
    Route::delete('equipment-types/destroy', 'EquipmentTypeController@massDestroy')->name('equipment-types.massDestroy');
    Route::resource('equipment-types', 'EquipmentTypeController');

    // Equipment
    Route::delete('equipment/destroy', 'EquipmentController@massDestroy')->name('equipment.massDestroy');
    Route::post('equipment/media', 'EquipmentController@storeMedia')->name('equipment.storeMedia');
    Route::post('equipment/ckmedia', 'EquipmentController@storeCKEditorImages')->name('equipment.storeCKEditorImages');
    Route::resource('equipment', 'EquipmentController');

    // Equipment Audit
    Route::delete('equipment-audits/destroy', 'EquipmentAuditController@massDestroy')->name('equipment-audits.massDestroy');
    Route::resource('equipment-audits', 'EquipmentAuditController');

    // Document Types
    Route::delete('document-types/destroy', 'DocumentTypesController@massDestroy')->name('document-types.massDestroy');
    Route::resource('document-types', 'DocumentTypesController');

    // File Types
    Route::delete('file-types/destroy', 'FileTypesController@massDestroy')->name('file-types.massDestroy');
    Route::resource('file-types', 'FileTypesController');

    // Documents
    Route::delete('documents/destroy', 'DocumentsController@massDestroy')->name('documents.massDestroy');
    Route::resource('documents', 'DocumentsController');

    // Price Lists
    Route::delete('price-lists/destroy', 'PriceListsController@massDestroy')->name('price-lists.massDestroy');
    Route::resource('price-lists', 'PriceListsController');

    // Product Code Groups
    Route::delete('product-code-groups/destroy', 'ProductCodeGroupsController@massDestroy')->name('product-code-groups.massDestroy');
    Route::resource('product-code-groups', 'ProductCodeGroupsController');

    // Product Functions
    Route::delete('product-functions/destroy', 'ProductFunctionsController@massDestroy')->name('product-functions.massDestroy');
    Route::resource('product-functions', 'ProductFunctionsController');

    // Product Development Stages
    Route::delete('product-development-stages/destroy', 'ProductDevelopmentStagesController@massDestroy')->name('product-development-stages.massDestroy');
    Route::resource('product-development-stages', 'ProductDevelopmentStagesController');

    // Packaging Types
    Route::delete('packaging-types/destroy', 'PackagingTypesController@massDestroy')->name('packaging-types.massDestroy');
    Route::post('packaging-types/media', 'PackagingTypesController@storeMedia')->name('packaging-types.storeMedia');
    Route::post('packaging-types/ckmedia', 'PackagingTypesController@storeCKEditorImages')->name('packaging-types.storeCKEditorImages');
    Route::resource('packaging-types', 'PackagingTypesController');

    // Packaging
    Route::delete('packagings/destroy', 'PackagingController@massDestroy')->name('packagings.massDestroy');
    Route::resource('packagings', 'PackagingController');

    // Prices
    Route::delete('prices/destroy', 'PricesController@massDestroy')->name('prices.massDestroy');
    Route::resource('prices', 'PricesController');

    // Fabric Groups
    Route::delete('fabric-groups/destroy', 'FabricGroupsController@massDestroy')->name('fabric-groups.massDestroy');
    Route::post('fabric-groups/media', 'FabricGroupsController@storeMedia')->name('fabric-groups.storeMedia');
    Route::post('fabric-groups/ckmedia', 'FabricGroupsController@storeCKEditorImages')->name('fabric-groups.storeCKEditorImages');
    Route::resource('fabric-groups', 'FabricGroupsController');

    // Departments
    Route::delete('departments/destroy', 'DepartmentsController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/media', 'DepartmentsController@storeMedia')->name('departments.storeMedia');
    Route::post('departments/ckmedia', 'DepartmentsController@storeCKEditorImages')->name('departments.storeCKEditorImages');
    Route::resource('departments', 'DepartmentsController');

    // Bank Accounts
    Route::delete('bank-accounts/destroy', 'BankAccountsController@massDestroy')->name('bank-accounts.massDestroy');
    Route::resource('bank-accounts', 'BankAccountsController');

    // Fabric
    Route::delete('fabrics/destroy', 'FabricController@massDestroy')->name('fabrics.massDestroy');
    Route::resource('fabrics', 'FabricController');

    // Fabric Price Bands
    Route::delete('fabric-price-bands/destroy', 'FabricPriceBandsController@massDestroy')->name('fabric-price-bands.massDestroy');
    Route::post('fabric-price-bands/media', 'FabricPriceBandsController@storeMedia')->name('fabric-price-bands.storeMedia');
    Route::post('fabric-price-bands/ckmedia', 'FabricPriceBandsController@storeCKEditorImages')->name('fabric-price-bands.storeCKEditorImages');
    Route::resource('fabric-price-bands', 'FabricPriceBandsController');

    // Fabric Nicknames
    Route::delete('fabric-nicknames/destroy', 'FabricNicknamesController@massDestroy')->name('fabric-nicknames.massDestroy');
    Route::resource('fabric-nicknames', 'FabricNicknamesController');

    // Product Groups
    Route::delete('product-groups/destroy', 'ProductGroupsController@massDestroy')->name('product-groups.massDestroy');
    Route::post('product-groups/media', 'ProductGroupsController@storeMedia')->name('product-groups.storeMedia');
    Route::post('product-groups/ckmedia', 'ProductGroupsController@storeCKEditorImages')->name('product-groups.storeCKEditorImages');
    Route::resource('product-groups', 'ProductGroupsController');

    // Bed Sizes By Region
    Route::delete('bed-sizes-by-regions/destroy', 'BedSizesByRegionController@massDestroy')->name('bed-sizes-by-regions.massDestroy');
    Route::resource('bed-sizes-by-regions', 'BedSizesByRegionController');

    // Bed Size Groups
    Route::delete('bed-size-groups/destroy', 'BedSizeGroupsController@massDestroy')->name('bed-size-groups.massDestroy');
    Route::post('bed-size-groups/media', 'BedSizeGroupsController@storeMedia')->name('bed-size-groups.storeMedia');
    Route::post('bed-size-groups/ckmedia', 'BedSizeGroupsController@storeCKEditorImages')->name('bed-size-groups.storeCKEditorImages');
    Route::resource('bed-size-groups', 'BedSizeGroupsController');

    // Inspections
    Route::delete('inspections/destroy', 'InspectionsController@massDestroy')->name('inspections.massDestroy');
    Route::resource('inspections', 'InspectionsController');

    // Ordertype
    Route::delete('ordertypes/destroy', 'OrdertypeController@massDestroy')->name('ordertypes.massDestroy');
    Route::resource('ordertypes', 'OrdertypeController');

    // Product Type
    Route::delete('product-types/destroy', 'ProductTypeController@massDestroy')->name('product-types.massDestroy');
    Route::resource('product-types', 'ProductTypeController');

    // Product Sku Letters
    Route::delete('product-sku-letters/destroy', 'ProductSkuLettersController@massDestroy')->name('product-sku-letters.massDestroy');
    Route::resource('product-sku-letters', 'ProductSkuLettersController');

    // Component Parts
    Route::delete('component-parts/destroy', 'ComponentPartsController@massDestroy')->name('component-parts.massDestroy');
    Route::resource('component-parts', 'ComponentPartsController');

    // Supplier Audit
    Route::delete('supplier-audits/destroy', 'SupplierAuditController@massDestroy')->name('supplier-audits.massDestroy');
    Route::resource('supplier-audits', 'SupplierAuditController');

    // Inspection Status
    Route::delete('inspection-statuses/destroy', 'InspectionStatusController@massDestroy')->name('inspection-statuses.massDestroy');
    Route::resource('inspection-statuses', 'InspectionStatusController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
