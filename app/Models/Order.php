<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'orders';

    public static $searchable = [
        'afa_order_num',
        'customer_order_number',
        'supplier',
    ];

    protected $dates = [
        'cust_order_date',
        'cust_dep_rec_date',
        'order_sent_to_supplier_date',
        'customer_required_ship_date',
        'crd_target_date',
        'booking_date',
        'so_date',
        'balance_received_date',
        'supplier_deposit_paid_date',
        'documents_received_date',
        'supplier_balance_paid_date',
        'commission_paid_date',
        'fn_audit_complete_date',
        'price_expiry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'afa_order_num',
        'cust_order_date',
        'sales_person_id',
        'order_follower_id',
        'order_status_id',
        'order_type_id',
        'ukfr',
        'customer_order_number',
        'customer_id',
        'order_placed_by_id',
        'shipping_agent_id',
        'ship_from_port_id',
        'ship_to_port_id',
        'ship_to_address_id',
        'bill_to_address_id',
        'pi_value_placed_usd',
        'ci_value_shipped_usd',
        'customer_deposit_value_usd',
        'customer_deposit_rate',
        'cust_dep_rec_date',
        'order_sent_to_supplier_date',
        'allowance_usd',
        'customer_required_ship_date',
        'crd_target_date',
        'booking_date',
        'so_date',
        'customer_balance_usd',
        'balance_received_date',
        'supplier_id',
        'po_value_placed_usd',
        'po_value_shipped_usd',
        'supplier_deposit_usd',
        'supplier_deposit_paid_date',
        'handling_charge_and_allowance_usd',
        'documents_received_date',
        'supplier_balance_usd',
        'supplier_balance_paid_date',
        'commission_usd',
        'commission_paid_date',
        'packaging_type_id',
        'req_fumigtion',
        'fumigation_cost_usd',
        'profit_usd',
        'profit_ratio',
        'fn_audit_complete_date',
        'total_days_to_complete',
        'qty_tolerance',
        'size_tolerance',
        'leadtime_days',
        'cny_to_usd_rate_today',
        'price_expiry_date',
        'afa_bank_account_to_pay_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function orderOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function orderShippingContainers()
    {
        return $this->hasMany(ShippingContainer::class, 'order_id', 'id');
    }

    public function orderOrderRoles()
    {
        return $this->hasMany(OrderRole::class, 'order_id', 'id');
    }

    public function orderInspections()
    {
        return $this->hasMany(Inspection::class, 'order_id', 'id');
    }

    public function orderIncomes()
    {
        return $this->hasMany(Income::class, 'order_id', 'id');
    }

    public function relatedOrdersDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function getCustOrderDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCustOrderDateAttribute($value)
    {
        $this->attributes['cust_order_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function sales_person()
    {
        return $this->belongsTo(ContactContact::class, 'sales_person_id');
    }

    public function order_follower()
    {
        return $this->belongsTo(AfaStaff::class, 'order_follower_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function order_type()
    {
        return $this->belongsTo(Ordertype::class, 'order_type_id');
    }

    public function customer()
    {
        return $this->belongsTo(ContactCompany::class, 'customer_id');
    }

    public function order_placed_by()
    {
        return $this->belongsTo(ContactContact::class, 'order_placed_by_id');
    }

    public function shipping_agent()
    {
        return $this->belongsTo(ContactCompany::class, 'shipping_agent_id');
    }

    public function ship_from_port()
    {
        return $this->belongsTo(Address::class, 'ship_from_port_id');
    }

    public function ship_to_port()
    {
        return $this->belongsTo(Address::class, 'ship_to_port_id');
    }

    public function ship_to_address()
    {
        return $this->belongsTo(Address::class, 'ship_to_address_id');
    }

    public function bill_to_address()
    {
        return $this->belongsTo(Address::class, 'bill_to_address_id');
    }

    public function getCustDepRecDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCustDepRecDateAttribute($value)
    {
        $this->attributes['cust_dep_rec_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getOrderSentToSupplierDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setOrderSentToSupplierDateAttribute($value)
    {
        $this->attributes['order_sent_to_supplier_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCustomerRequiredShipDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCustomerRequiredShipDateAttribute($value)
    {
        $this->attributes['customer_required_ship_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCrdTargetDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCrdTargetDateAttribute($value)
    {
        $this->attributes['crd_target_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function quality_control_staffs()
    {
        return $this->belongsToMany(AfaStaff::class);
    }

    public function getBookingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBookingDateAttribute($value)
    {
        $this->attributes['booking_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSoDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSoDateAttribute($value)
    {
        $this->attributes['so_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBalanceReceivedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBalanceReceivedDateAttribute($value)
    {
        $this->attributes['balance_received_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function supplier()
    {
        return $this->belongsTo(ContactCompany::class, 'supplier_id');
    }

    public function getSupplierDepositPaidDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSupplierDepositPaidDateAttribute($value)
    {
        $this->attributes['supplier_deposit_paid_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocumentsReceivedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDocumentsReceivedDateAttribute($value)
    {
        $this->attributes['documents_received_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSupplierBalancePaidDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSupplierBalancePaidDateAttribute($value)
    {
        $this->attributes['supplier_balance_paid_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCommissionPaidDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCommissionPaidDateAttribute($value)
    {
        $this->attributes['commission_paid_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function packaging_type()
    {
        return $this->belongsTo(PackagingType::class, 'packaging_type_id');
    }

    public function getFnAuditCompleteDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFnAuditCompleteDateAttribute($value)
    {
        $this->attributes['fn_audit_complete_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPriceExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPriceExpiryDateAttribute($value)
    {
        $this->attributes['price_expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function afa_bank_account_to_pay()
    {
        return $this->belongsTo(BankAccount::class, 'afa_bank_account_to_pay_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
