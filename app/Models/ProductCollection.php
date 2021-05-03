<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCollection extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_collections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'public_logo_url',
        'public_url',
        'share_point_url',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productCollectionProducts()
    {
        return $this->hasMany(Product::class, 'product_collection_id', 'id');
    }

    public function productCollectionProductCodeGroups()
    {
        return $this->belongsToMany(ProductCodeGroup::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
