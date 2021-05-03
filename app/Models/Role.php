<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function roleOrderRoles()
    {
        return $this->hasMany(OrderRole::class, 'role_id', 'id');
    }

    public function roleCompanyRoles()
    {
        return $this->hasMany(CompanyRole::class, 'role_id', 'id');
    }

    public function rolesContactContacts()
    {
        return $this->belongsToMany(ContactContact::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
