<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionStatus extends Model
{
    use SoftDeletes;

    public $table = 'inspection_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'list_order',
        'status_color_hex',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function qcStatusInspections()
    {
        return $this->hasMany(Inspection::class, 'qc_status_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
