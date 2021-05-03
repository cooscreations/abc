<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'price_lists';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type_id',
        'group_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function priceListPrices()
    {
        return $this->hasMany(Price::class, 'price_list_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(PriceListType::class, 'type_id');
    }

    public function group()
    {
        return $this->belongsTo(PriceListGroup::class, 'group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
