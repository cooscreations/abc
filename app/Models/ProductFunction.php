<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFunction extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_functions';

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
        'public_icon_url',
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function defaultFunctionProducts()
    {
        return $this->hasMany(Product::class, 'default_function_id', 'id');
    }

    public function productFunctionProductCodeGroups()
    {
        return $this->belongsToMany(ProductCodeGroup::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
