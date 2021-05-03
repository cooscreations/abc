<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'prices';

    public static $searchable = [
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sku_id',
        'default_raw_material_id',
        'price_list_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'sku_id');
    }

    public function default_raw_material()
    {
        return $this->belongsTo(RawMaterial::class, 'default_raw_material_id');
    }

    public function price_list()
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
