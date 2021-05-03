<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'languages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'alpha_2',
        'local_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function defaultLanguageContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'default_language_id', 'id');
    }

    public function primaryLanguageContactCompanies()
    {
        return $this->hasMany(ContactCompany::class, 'primary_language_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
