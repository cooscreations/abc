<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'order_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_id',
        'quantity',
        'product_id',
        'product_sku_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function orderItemInspections()
    {
        return $this->hasMany(Inspection::class, 'order_item_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
