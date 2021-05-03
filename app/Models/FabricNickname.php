<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricNickname extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'fabric_nicknames';

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
        'fabric_id',
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class, 'fabric_id');
    }

    public function customer()
    {
        return $this->belongsTo(ContactCompany::class, 'customer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
