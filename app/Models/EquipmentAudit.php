<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentAudit extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'equipment_audits';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'equipment_id',
        'company_id',
        'qty',
        'location_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function location()
    {
        return $this->belongsTo(Address::class, 'location_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
