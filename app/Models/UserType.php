<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'user_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'list_order',
        'auth_level',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function authorisedUserTypesDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
