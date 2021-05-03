<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packaging extends Model
{
    use SoftDeletes;

    public $table = 'packagings';

    public static $searchable = [
        'product',
        'notes',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'type_id',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function stdPackagingProducts()
    {
        return $this->hasMany(Product::class, 'std_packaging_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function type()
    {
        return $this->belongsTo(PackagingType::class, 'type_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
