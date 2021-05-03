<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceListGroup extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'price_list_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function groupPriceLists()
    {
        return $this->hasMany(PriceList::class, 'group_id', 'id');
    }

    public function priceGroupBedSizeGroups()
    {
        return $this->hasMany(BedSizeGroup::class, 'price_group_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
