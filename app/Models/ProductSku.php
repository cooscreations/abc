<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSku extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_skus';

    public static $searchable = [
        'product_sku',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_sku',
        'product_id',
        'prod_dev_stage_id',
        'size_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function skuPrices()
    {
        return $this->hasMany(Price::class, 'sku_id', 'id');
    }

    public function productSkuComponentParts()
    {
        return $this->hasMany(ComponentPart::class, 'product_sku_id', 'id');
    }

    public function productSkuOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_sku_id', 'id');
    }

    public function relatedSkuDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function prod_dev_stage()
    {
        return $this->belongsTo(ProductDevelopmentStage::class, 'prod_dev_stage_id');
    }

    public function size()
    {
        return $this->belongsTo(BedSizesByRegion::class, 'size_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
