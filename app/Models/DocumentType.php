<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'document_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'notes',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function documentTypeDocuments()
    {
        return $this->hasMany(Document::class, 'document_type_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
