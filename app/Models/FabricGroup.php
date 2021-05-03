<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class FabricGroup extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'fabric_groups';

    public static $searchable = [
        'name',
        'afa_fabric_group_code',
        'primary_supplier_group_code',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'afa_fabric_group_code',
        'primary_supplier_id',
        'primary_supplier_group_code',
        'sharepoint_url',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fabricGroupFabrics()
    {
        return $this->hasMany(Fabric::class, 'fabric_group_id', 'id');
    }

    public function primary_supplier()
    {
        return $this->belongsTo(ContactCompany::class, 'primary_supplier_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
