<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyRole extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'company_roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_id',
        'role_id',
        'contact_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function contact()
    {
        return $this->belongsTo(ContactContact::class, 'contact_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
