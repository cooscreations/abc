<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfaStaff extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'afa_staffs';

    public static $searchable = [
        'full_name',
        'staff_bio',
    ];

    protected $dates = [
        'date_started',
        'date_finished',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'user_id',
        'staff_level_id',
        'reports_to_id',
        'date_started',
        'date_finished',
        'staff_bio',
        'department_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function inspectorNameInspections()
    {
        return $this->hasMany(Inspection::class, 'inspector_name_id', 'id');
    }

    public function orderFollowerOrders()
    {
        return $this->hasMany(Order::class, 'order_follower_id', 'id');
    }

    public function orderFollowerInspections()
    {
        return $this->hasMany(Inspection::class, 'order_follower_id', 'id');
    }

    public function qualityControlStaffOrders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function additionalQCsInspections()
    {
        return $this->belongsToMany(Inspection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff_level()
    {
        return $this->belongsTo(StaffLevel::class, 'staff_level_id');
    }

    public function reports_to()
    {
        return $this->belongsTo(User::class, 'reports_to_id');
    }

    public function getDateStartedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateStartedAttribute($value)
    {
        $this->attributes['date_started'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateFinishedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateFinishedAttribute($value)
    {
        $this->attributes['date_finished'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
