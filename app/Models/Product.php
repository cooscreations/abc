<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'products';

    public static $searchable = [
        'afa_model_number',
        'public_description',
        'internal_notes',
    ];

    protected $appends = [
        'beauty_shot',
        'iso_naked',
        'other_photos',
    ];

    protected $dates = [
        'date_launched',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'afa_model_number',
        'primary_nickname_id',
        'product_code_group_id',
        'default_function_id',
        'product_collection_id',
        'default_group_id',
        'default_storage_id',
        'default_gas_lift_config_id',
        'default_drawer_config_id',
        'default_drawer_movement_id',
        'default_tv_config_id',
        'default_visitor_config_id',
        'primary_material_id',
        'date_launched',
        'std_qty_feet',
        'std_qty_boxes',
        'std_packaging_id',
        'public_description',
        'internal_notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function productProductNicknames()
    {
        return $this->hasMany(ProductNickname::class, 'product_id', 'id');
    }

    public function productProductSkus()
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id');
    }

    public function productOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function productPackagings()
    {
        return $this->hasMany(Packaging::class, 'product_id', 'id');
    }

    public function relatedProductsDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function primary_nickname()
    {
        return $this->belongsTo(ProductNickname::class, 'primary_nickname_id');
    }

    public function product_code_group()
    {
        return $this->belongsTo(ProductCodeGroup::class, 'product_code_group_id');
    }

    public function default_function()
    {
        return $this->belongsTo(ProductFunction::class, 'default_function_id');
    }

    public function product_collection()
    {
        return $this->belongsTo(ProductCollection::class, 'product_collection_id');
    }

    public function default_group()
    {
        return $this->belongsTo(ProductGroup::class, 'default_group_id');
    }

    public function default_storage()
    {
        return $this->belongsTo(StorageOption::class, 'default_storage_id');
    }

    public function default_gas_lift_config()
    {
        return $this->belongsTo(GasLiftConfig::class, 'default_gas_lift_config_id');
    }

    public function default_drawer_config()
    {
        return $this->belongsTo(DrawerConfig::class, 'default_drawer_config_id');
    }

    public function default_drawer_movement()
    {
        return $this->belongsTo(DrawerMovement::class, 'default_drawer_movement_id');
    }

    public function default_tv_config()
    {
        return $this->belongsTo(TvBedConfig::class, 'default_tv_config_id');
    }

    public function default_visitor_config()
    {
        return $this->belongsTo(VisitorBedConfig::class, 'default_visitor_config_id');
    }

    public function extra_letters_used_in_skus()
    {
        return $this->belongsToMany(ProductSkuLetter::class);
    }

    public function primary_material()
    {
        return $this->belongsTo(RawMaterial::class, 'primary_material_id');
    }

    public function getDateLaunchedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateLaunchedAttribute($value)
    {
        $this->attributes['date_launched'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function primary_suppliers()
    {
        return $this->belongsToMany(ContactCompany::class);
    }

    public function std_packaging()
    {
        return $this->belongsTo(Packaging::class, 'std_packaging_id');
    }

    public function getBeautyShotAttribute()
    {
        $file = $this->getMedia('beauty_shot')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getIsoNakedAttribute()
    {
        $file = $this->getMedia('iso_naked')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getOtherPhotosAttribute()
    {
        $files = $this->getMedia('other_photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
