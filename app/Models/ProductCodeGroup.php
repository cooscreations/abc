<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCodeGroup extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_code_groups';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'range_start',
        'range_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productCodeGroupProducts()
    {
        return $this->hasMany(Product::class, 'product_code_group_id', 'id');
    }

    public function product_collections()
    {
        return $this->belongsToMany(ProductCollection::class);
    }

    public function product_functions()
    {
        return $this->belongsToMany(ProductFunction::class);
    }

    public function product_types()
    {
        return $this->belongsToMany(ProductType::class);
    }

    public function storage_options()
    {
        return $this->belongsToMany(StorageOption::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
