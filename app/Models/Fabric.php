<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabric extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'fabrics';

    public static $searchable = [
        'name',
        'fabric_group',
        'fabric_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'fabric_group_id',
        'fabric_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fabricFabricNicknames()
    {
        return $this->hasMany(FabricNickname::class, 'fabric_id', 'id');
    }

    public function fabric_group()
    {
        return $this->belongsTo(FabricGroup::class, 'fabric_group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
