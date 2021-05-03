<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentPart extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'component_parts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_sku_id',
        'component_part_name_id',
        'quantity',
        'has_fabric_finish_choice',
        'is_sub_assembly',
        'raw_material_id',
        'length_mm',
        'width_mm',
        'height_mm',
        'weight_g',
        'is_optional',
        'default_product_group_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product_sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public function component_part_name()
    {
        return $this->belongsTo(ComponentPartName::class, 'component_part_name_id');
    }

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }

    public function primary_suppliers()
    {
        return $this->belongsToMany(ContactCompany::class);
    }

    public function default_product_group()
    {
        return $this->belongsTo(ProductGroup::class, 'default_product_group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
