<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSkuLetter extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_sku_letters';

    public static $searchable = [
        'full_name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'letter_code',
        'full_name',
        'description',
        'sharepoint_url',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function extraLettersUsedInSkuProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
