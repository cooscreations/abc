<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'file_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'hex_color_code',
        'description',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fileTypeDocuments()
    {
        return $this->hasMany(Document::class, 'file_type_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
