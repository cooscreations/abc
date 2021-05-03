<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDevelopmentStage extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'product_development_stages';

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
        'list_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function prodDevStageProductSkus()
    {
        return $this->hasMany(ProductSku::class, 'prod_dev_stage_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
