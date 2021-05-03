<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BedSizesByRegion extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'bed_sizes_by_regions';

    public static $searchable = [
        'name',
        'size_code',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'size_code',
        'world_region_id',
        'size_name_id',
        'base_style_id',
        'description',
        'mattress_w_mm',
        'mattress_l_mm',
        'imperial_l_ft_in',
        'imperial_w_ft_in',
        'imperial_nickname',
        'plank_approx_extra_usd',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sizeProductSkus()
    {
        return $this->hasMany(ProductSku::class, 'size_id', 'id');
    }

    public function world_region()
    {
        return $this->belongsTo(WorldRegion::class, 'world_region_id');
    }

    public function size_name()
    {
        return $this->belongsTo(ProductSizeName::class, 'size_name_id');
    }

    public function base_style()
    {
        return $this->belongsTo(BaseStyle::class, 'base_style_id');
    }

    public function related_size_groups()
    {
        return $this->belongsToMany(BedSizeGroup::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
