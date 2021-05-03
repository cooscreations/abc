<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_types';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'public_url',
        'public_icon_url',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productTypeProductCodeGroups()
    {
        return $this->belongsToMany(ProductCodeGroup::class);
    }

    public function client1ProductTypeSupplierAudits()
    {
        return $this->belongsToMany(SupplierAudit::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
