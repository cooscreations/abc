<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'addresses';

    public static $searchable = [
        'name',
        'add_line_1',
        'add_line_2',
        'add_line_3',
        'city',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'company_id',
        'add_line_1',
        'add_line_2',
        'add_line_3',
        'city',
        'province_id',
        'country_id',
        'is_billing_address',
        'is_shipping_address',
        'nearest_shipping_port_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function billToAddressOrders()
    {
        return $this->hasMany(Order::class, 'bill_to_address_id', 'id');
    }

    public function shipToAddressOrders()
    {
        return $this->hasMany(Order::class, 'ship_to_address_id', 'id');
    }

    public function locationEquipmentAudits()
    {
        return $this->hasMany(EquipmentAudit::class, 'location_id', 'id');
    }

    public function addressBankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'address_id', 'id');
    }

    public function primaryAddressContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'primary_address_id', 'id');
    }

    public function nearestShippingPortAddresses()
    {
        return $this->hasMany(Address::class, 'nearest_shipping_port_id', 'id');
    }

    public function shipFromPortOrders()
    {
        return $this->hasMany(Order::class, 'ship_from_port_id', 'id');
    }

    public function shipToPortOrders()
    {
        return $this->hasMany(Order::class, 'ship_to_port_id', 'id');
    }

    public function addressesContactCompanies()
    {
        return $this->belongsToMany(ContactCompany::class);
    }

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function nearest_shipping_port()
    {
        return $this->belongsTo(Address::class, 'nearest_shipping_port_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
