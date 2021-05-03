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

class ContactContact extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'contact_contacts';

    public static $searchable = [
        'full_name',
        'local_name',
        'wechat',
    ];

    protected $appends = [
        'photo',
        'business_card',
        'qr_code',
    ];

    protected $dates = [
        'date_of_birth',
        'nda_signed_date',
        'honesty_agreement_signed_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'contact_first_name',
        'contact_last_name',
        'full_name',
        'local_name',
        'country_of_birth_id',
        'primary_address_id',
        'current_country_id',
        'company_id',
        'wechat',
        'linkedin_url',
        'facebook_url',
        'contact_email',
        'personal_email',
        'office_phone',
        'mobile_phone',
        'personal_url',
        'date_of_birth',
        'default_language_id',
        'nda_signed_date',
        'honesty_agreement_signed_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function ownerContactContactCompanies()
    {
        return $this->hasMany(ContactCompany::class, 'owner_contact_id', 'id');
    }

    public function orderPlacedByOrders()
    {
        return $this->hasMany(Order::class, 'order_placed_by_id', 'id');
    }

    public function contactOrderRoles()
    {
        return $this->hasMany(OrderRole::class, 'contact_id', 'id');
    }

    public function contactCompanyRoles()
    {
        return $this->hasMany(CompanyRole::class, 'contact_id', 'id');
    }

    public function salesPersonOrders()
    {
        return $this->hasMany(Order::class, 'sales_person_id', 'id');
    }

    public function relatedContactsDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country_of_birth()
    {
        return $this->belongsTo(Country::class, 'country_of_birth_id');
    }

    public function primary_address()
    {
        return $this->belongsTo(Address::class, 'primary_address_id');
    }

    public function current_country()
    {
        return $this->belongsTo(Country::class, 'current_country_id');
    }

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBusinessCardAttribute()
    {
        $files = $this->getMedia('business_card');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getQrCodeAttribute()
    {
        $file = $this->getMedia('qr_code')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function default_language()
    {
        return $this->belongsTo(Language::class, 'default_language_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getNdaSignedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setNdaSignedDateAttribute($value)
    {
        $this->attributes['nda_signed_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHonestyAgreementSignedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHonestyAgreementSignedDateAttribute($value)
    {
        $this->attributes['honesty_agreement_signed_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
