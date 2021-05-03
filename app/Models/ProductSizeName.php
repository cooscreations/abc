<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSizeName extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_size_names';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'description',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sizeNameBedSizesByRegions()
    {
        return $this->hasMany(BedSizesByRegion::class, 'size_name_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
