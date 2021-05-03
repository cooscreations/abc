<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('order_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/orders*") ? "c-show" : "" }} {{ request()->is("admin/order-items*") ? "c-show" : "" }} {{ request()->is("admin/shipping-containers*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.orderManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.order.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.order-items.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-items") || request()->is("admin/order-items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderItem.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('shipping_container_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shipping-containers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shipping-containers") || request()->is("admin/shipping-containers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-shipping-fast c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shippingContainer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/order-statuses*") ? "c-show" : "" }} {{ request()->is("admin/order-roles*") ? "c-show" : "" }} {{ request()->is("admin/ordertypes*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('order_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.order-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-statuses") || request()->is("admin/order-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-signal c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.orderStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('order_role_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.order-roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-roles") || request()->is("admin/order-roles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.orderRole.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('ordertype_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.ordertypes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ordertypes") || request()->is("admin/ordertypes/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.ordertype.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('complaints_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/complaints*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-exclamation-triangle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.complaintsManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('complaint_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.complaints.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/complaints") || request()->is("admin/complaints/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exclamation-triangle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.complaint.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('complaint_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/complaint-statuses*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.complaintConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('complaint_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.complaint-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/complaint-statuses") || request()->is("admin/complaint-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-signal c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.complaintStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/user-types*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('permission_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('role_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('user_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.user-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-types") || request()->is("admin/user-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.userType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('user_alert_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.userAlert.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('staff_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/afa-staffs*") ? "c-show" : "" }} {{ request()->is("admin/staff-levels*") ? "c-show" : "" }} {{ request()->is("admin/departments*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.staffManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('afa_staff_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.afa-staffs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/afa-staffs") || request()->is("admin/afa-staffs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.afaStaff.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('staff_level_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.staff-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/staff-levels") || request()->is("admin/staff-levels/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-center c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.staffLevel.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('department_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.department.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/contact-companies*") ? "c-show" : "" }} {{ request()->is("admin/contact-contacts*") ? "c-show" : "" }} {{ request()->is("admin/addresses*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-phone-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contact_company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-companies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactCompany.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_contact_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactContact.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('address_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.addresses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.address.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contacts_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/company-types*") ? "c-show" : "" }} {{ request()->is("admin/company-ownership-types*") ? "c-show" : "" }} {{ request()->is("admin/company-roles*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactsConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('company_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.company-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company-types") || request()->is("admin/company-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.companyType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('company_ownership_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.company-ownership-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company-ownership-types") || request()->is("admin/company-ownership-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.companyOwnershipType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('company_role_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.company-roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company-roles") || request()->is("admin/company-roles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.companyRole.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('expense_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/expense-reports*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.expenseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/currencies*") ? "c-show" : "" }} {{ request()->is("admin/currency-rates*") ? "c-show" : "" }} {{ request()->is("admin/expense-categories*") ? "c-show" : "" }} {{ request()->is("admin/income-categories*") ? "c-show" : "" }} {{ request()->is("admin/bank-accounts*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('currency_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.currencies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.currency.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('currency_rate_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.currency-rates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/currency-rates") || request()->is("admin/currency-rates/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.currencyRate.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('expense_category_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.expense-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('income_category_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.income-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('bank_account_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bank-accounts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-accounts") || request()->is("admin/bank-accounts/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bankAccount.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/product-skus*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bed c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bed c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_sku_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-skus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-skus") || request()->is("admin/product-skus/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bed c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productSku.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-collections*") ? "c-show" : "" }} {{ request()->is("admin/product-groups*") ? "c-show" : "" }} {{ request()->is("admin/product-functions*") ? "c-show" : "" }} {{ request()->is("admin/product-types*") ? "c-show" : "" }} {{ request()->is("admin/product-nicknames*") ? "c-show" : "" }} {{ request()->is("admin/product-development-stages*") ? "c-show" : "" }} {{ request()->is("admin/component-part-names*") ? "c-show" : "" }} {{ request()->is("admin/product-size-names*") ? "c-show" : "" }} {{ request()->is("admin/base-styles*") ? "c-show" : "" }} {{ request()->is("admin/storage-options*") ? "c-show" : "" }} {{ request()->is("admin/gas-lift-configs*") ? "c-show" : "" }} {{ request()->is("admin/tv-bed-configs*") ? "c-show" : "" }} {{ request()->is("admin/drawer-configs*") ? "c-show" : "" }} {{ request()->is("admin/drawer-movements*") ? "c-show" : "" }} {{ request()->is("admin/visitor-bed-configs*") ? "c-show" : "" }} {{ request()->is("admin/product-code-groups*") ? "c-show" : "" }} {{ request()->is("admin/bed-sizes-by-regions*") ? "c-show" : "" }} {{ request()->is("admin/bed-size-groups*") ? "c-show" : "" }} {{ request()->is("admin/product-sku-letters*") ? "c-show" : "" }} {{ request()->is("admin/component-parts*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('product_collection_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-collections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-collections") || request()->is("admin/product-collections/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-gem c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productCollection.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_group_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-groups") || request()->is("admin/product-groups/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-tag c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productGroup.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_function_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-functions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-functions") || request()->is("admin/product-functions/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productFunction.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-types") || request()->is("admin/product-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_nickname_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-nicknames.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-nicknames") || request()->is("admin/product-nicknames/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-comment-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productNickname.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_development_stage_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-development-stages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-development-stages") || request()->is("admin/product-development-stages/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productDevelopmentStage.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('component_part_name_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.component-part-names.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/component-part-names") || request()->is("admin/component-part-names/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.componentPartName.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_size_name_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-size-names.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-size-names") || request()->is("admin/product-size-names/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-expand-arrows-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productSizeName.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('base_style_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.base-styles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/base-styles") || request()->is("admin/base-styles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-bars c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.baseStyle.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('storage_option_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.storage-options.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/storage-options") || request()->is("admin/storage-options/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.storageOption.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('gas_lift_config_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.gas-lift-configs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/gas-lift-configs") || request()->is("admin/gas-lift-configs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-angle-double-up c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.gasLiftConfig.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('tv_bed_config_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tv-bed-configs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tv-bed-configs") || request()->is("admin/tv-bed-configs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-tv c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.tvBedConfig.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('drawer_config_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.drawer-configs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/drawer-configs") || request()->is("admin/drawer-configs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.drawerConfig.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('drawer_movement_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.drawer-movements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/drawer-movements") || request()->is("admin/drawer-movements/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-sliders-h c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.drawerMovement.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('visitor_bed_config_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.visitor-bed-configs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/visitor-bed-configs") || request()->is("admin/visitor-bed-configs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.visitorBedConfig.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_code_group_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-code-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-code-groups") || request()->is("admin/product-code-groups/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productCodeGroup.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('bed_sizes_by_region_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bed-sizes-by-regions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bed-sizes-by-regions") || request()->is("admin/bed-sizes-by-regions/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-globe-americas c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bedSizesByRegion.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('bed_size_group_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bed-size-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bed-size-groups") || request()->is("admin/bed-size-groups/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-expand-arrows-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bedSizeGroup.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_sku_letter_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-sku-letters.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-sku-letters") || request()->is("admin/product-sku-letters/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-sort-alpha-down c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productSkuLetter.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('component_part_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.component-parts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/component-parts") || request()->is("admin/component-parts/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-chess c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.componentPart.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('cff_colour_fabric_finish_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/fabrics*") ? "c-show" : "" }} {{ request()->is("admin/fabric-groups*") ? "c-show" : "" }} {{ request()->is("admin/fabric-price-bands*") ? "c-show" : "" }} {{ request()->is("admin/raw-material-types*") ? "c-show" : "" }} {{ request()->is("admin/material-finishes*") ? "c-show" : "" }} {{ request()->is("admin/raw-materials*") ? "c-show" : "" }} {{ request()->is("admin/fabric-nicknames*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-palette c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cffColourFabricFinish.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('fabric_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.fabrics.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fabrics") || request()->is("admin/fabrics/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-map c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fabric.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('fabric_group_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.fabric-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fabric-groups") || request()->is("admin/fabric-groups/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-map c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fabricGroup.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('fabric_price_band_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.fabric-price-bands.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fabric-price-bands") || request()->is("admin/fabric-price-bands/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-certificate c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fabricPriceBand.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('raw_material_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.raw-material-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/raw-material-types") || request()->is("admin/raw-material-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-tree c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.rawMaterialType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('material_finish_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.material-finishes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/material-finishes") || request()->is("admin/material-finishes/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-brush c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.materialFinish.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('raw_material_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.raw-materials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/raw-materials") || request()->is("admin/raw-materials/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-leaf c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.rawMaterial.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('fabric_nickname_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.fabric-nicknames.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fabric-nicknames") || request()->is("admin/fabric-nicknames/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-comments c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fabricNickname.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/yes-no-maybes*") ? "c-show" : "" }} {{ request()->is("admin/languages*") ? "c-show" : "" }} {{ request()->is("admin/world-regions*") ? "c-show" : "" }} {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/provinces*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('yes_no_maybe_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.yes-no-maybes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/yes-no-maybes") || request()->is("admin/yes-no-maybes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.yesNoMaybe.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('language_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.languages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-language c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.language.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('world_region_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.world-regions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/world-regions") || request()->is("admin/world-regions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-signs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.worldRegion.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('province_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.provinces.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.province.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('price_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/price-lists*") ? "c-show" : "" }} {{ request()->is("admin/prices*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-check-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.priceManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('price_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.price-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/price-lists") || request()->is("admin/price-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.priceList.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('price_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.prices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/prices") || request()->is("admin/prices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.price.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('price_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/price-list-types*") ? "c-show" : "" }} {{ request()->is("admin/price-list-groups*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.priceConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('price_list_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.price-list-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/price-list-types") || request()->is("admin/price-list-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.priceListType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('price_list_group_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.price-list-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/price-list-groups") || request()->is("admin/price-list-groups/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.priceListGroup.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('equipment_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/equipment*") ? "c-show" : "" }} {{ request()->is("admin/equipment-types*") ? "c-show" : "" }} {{ request()->is("admin/equipment-audits*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-robot c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.equipmentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('equipment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.equipment.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/equipment") || request()->is("admin/equipment/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-robot c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.equipment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('equipment_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.equipment-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/equipment-types") || request()->is("admin/equipment-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.equipmentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('equipment_audit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.equipment-audits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/equipment-audits") || request()->is("admin/equipment-audits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-robot c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.equipmentAudit.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('document_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/documents*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-folder-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.documentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('document_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/documents") || request()->is("admin/documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.document.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('document_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/document-types*") ? "c-show" : "" }} {{ request()->is("admin/file-types*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.documentConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('document_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.document-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/document-types") || request()->is("admin/document-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.documentType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('file_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.file-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/file-types") || request()->is("admin/file-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-copy c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fileType.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('packaging_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/packagings*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.packagingManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('packaging_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.packagings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/packagings") || request()->is("admin/packagings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.packaging.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('packaging_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/packaging-types*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.packagingConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('packaging_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.packaging-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/packaging-types") || request()->is("admin/packaging-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.packagingType.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('inspection_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/inspections*") ? "c-show" : "" }} {{ request()->is("admin/supplier-audits*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-search c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.inspectionManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('inspection_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.inspections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/inspections") || request()->is("admin/inspections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-search c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.inspection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('supplier_audit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.supplier-audits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/supplier-audits") || request()->is("admin/supplier-audits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.supplierAudit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('inspection_config_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/inspection-statuses*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.inspectionConfig.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('inspection_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.inspection-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/inspection-statuses") || request()->is("admin/inspection-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.inspectionStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>