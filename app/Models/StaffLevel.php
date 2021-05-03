<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffLevel extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'staff_levels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function staffLevelAfaStaffs()
    {
        return $this->hasMany(AfaStaff::class, 'staff_level_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
