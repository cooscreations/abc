<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'order_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function orderStatusOrders()
    {
        return $this->hasMany(Order::class, 'order_status_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
