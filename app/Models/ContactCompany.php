<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCompany extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'contact_companies';

    public static $searchable = [
        'company_short_code',
        'formal_reg_name',
        'local_name',
        'company_reg_num',
        'export_license_num',
        'import_license_num',
    ];

    protected $dates = [
        'company_reg_date',
        'company_reg_expiry',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_short_code',
        'company_name',
        'parent_company_id',
        'company_website',
        'company_email',
        'primary_company_type_id',
        'reg_country_id',
        'formal_reg_name',
        'local_name',
        'company_reg_date',
        'has_english_speaking_staff',
        'owner_contact_id',
        'ownership_type_id',
        'company_reg_num',
        'company_reg_expiry',
        'export_license_num',
        'import_license_num',
        'social_9001',
        'production_9001',
        'anti_slavery_policy',
        'bsci_certified',
        'primary_language_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function companyProductNicknames()
    {
        return $this->hasMany(ProductNickname::class, 'company_id', 'id');
    }

    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function supplierOrders()
    {
        return $this->hasMany(Order::class, 'supplier_id', 'id');
    }

    public function companyAddresses()
    {
        return $this->hasMany(Address::class, 'company_id', 'id');
    }

    public function shippingCompanyShippingContainers()
    {
        return $this->hasMany(ShippingContainer::class, 'shipping_company_id', 'id');
    }

    public function companyCompanyRoles()
    {
        return $this->hasMany(CompanyRole::class, 'company_id', 'id');
    }

    public function manufacturerEquipment()
    {
        return $this->hasMany(Equipment::class, 'manufacturer_id', 'id');
    }

    public function companyEquipmentAudits()
    {
        return $this->hasMany(EquipmentAudit::class, 'company_id', 'id');
    }

    public function primarySupplierFabricGroups()
    {
        return $this->hasMany(FabricGroup::class, 'primary_supplier_id', 'id');
    }

    public function companyBankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'company_id', 'id');
    }

    public function customerFabricNicknames()
    {
        return $this->hasMany(FabricNickname::class, 'customer_id', 'id');
    }

    public function supplierInspections()
    {
        return $this->hasMany(Inspection::class, 'supplier_id', 'id');
    }

    public function customerInspections()
    {
        return $this->hasMany(Inspection::class, 'customer_id', 'id');
    }

    public function shippingAgentOrders()
    {
        return $this->hasMany(Order::class, 'shipping_agent_id', 'id');
    }

    public function supplierSupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'supplier_id', 'id');
    }

    public function client1CompanySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_1_company_id', 'id');
    }

    public function client2CompanySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_2_company_id', 'id');
    }

    public function client3CompanySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_3_company_id', 'id');
    }

    public function parentCompanyContactCompanies()
    {
        return $this->hasMany(ContactCompany::class, 'parent_company_id', 'id');
    }

    public function relatedCompaniesDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function primarySuppliersProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function primarySupplierComponentParts()
    {
        return $this->belongsToMany(ComponentPart::class);
    }

    public function parent_company()
    {
        return $this->belongsTo(ContactCompany::class, 'parent_company_id');
    }

    public function primary_company_type()
    {
        return $this->belongsTo(CompanyType::class, 'primary_company_type_id');
    }

    public function reg_country()
    {
        return $this->belongsTo(Country::class, 'reg_country_id');
    }

    public function getCompanyRegDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCompanyRegDateAttribute($value)
    {
        $this->attributes['company_reg_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function owner_contact()
    {
        return $this->belongsTo(ContactContact::class, 'owner_contact_id');
    }

    public function ownership_type()
    {
        return $this->belongsTo(CompanyOwnershipType::class, 'ownership_type_id');
    }

    public function getCompanyRegExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCompanyRegExpiryAttribute($value)
    {
        $this->attributes['company_reg_expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function primary_language()
    {
        return $this->belongsTo(Language::class, 'primary_language_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
