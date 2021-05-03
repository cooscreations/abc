<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class RawMaterial extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'raw_materials';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'notes',
        'is_vegan',
        'is_sustainable',
        'is_ukfr_std',
        'is_ukfr_treatable',
        'std_material_finish_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function primaryMaterialPackagingTypes()
    {
        return $this->hasMany(PackagingType::class, 'primary_material_id', 'id');
    }

    public function defaultRawMaterialPrices()
    {
        return $this->hasMany(Price::class, 'default_raw_material_id', 'id');
    }

    public function primaryMaterialProducts()
    {
        return $this->hasMany(Product::class, 'primary_material_id', 'id');
    }

    public function rawMaterialComponentParts()
    {
        return $this->hasMany(ComponentPart::class, 'raw_material_id', 'id');
    }

    public function primaryMaterialsSupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'primary_materials_id', 'id');
    }

    public function std_material_finish()
    {
        return $this->belongsTo(MaterialFinish::class, 'std_material_finish_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
