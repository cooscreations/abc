<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductNickname extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'product_nicknames';

    public static $searchable = [
        'name',
        'alt_code',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'company_id',
        'product_id',
        'alt_code',
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

    public function primaryNicknameProducts()
    {
        return $this->hasMany(Product::class, 'primary_nickname_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
