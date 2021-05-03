<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BedSizeGroup extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'bed_size_groups';

    public static $searchable = [
        'name',
        'add_pt_approx_usd',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price_group_id',
        'group_number',
        'is_ukfr',
        'mattress_min_w_mm',
        'mattress_max_w_mm',
        'mattress_min_l_mm',
        'mattress_max_l_mm',
        'add_gl_approx_usd',
        'add_pt_approx_usd',
        'add_2_drawers_approx_usd',
        'add_mailorder_pkg_approx_usd',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function relatedSizeGroupsBedSizesByRegions()
    {
        return $this->belongsToMany(BedSizesByRegion::class);
    }

    public function price_group()
    {
        return $this->belongsTo(PriceListGroup::class, 'price_group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
