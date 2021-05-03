<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    public $table = 'documents';

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
        'document_type_id',
        'file_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function related_orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function related_products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function related_skus()
    {
        return $this->belongsToMany(ProductSku::class);
    }

    public function related_users()
    {
        return $this->belongsToMany(User::class);
    }

    public function related_companies()
    {
        return $this->belongsToMany(ContactCompany::class);
    }

    public function related_contacts()
    {
        return $this->belongsToMany(ContactContact::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function file_type()
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function authorised_user_types()
    {
        return $this->belongsToMany(UserType::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
