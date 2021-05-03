<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Country extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'countries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'short_code',
        'alpha_2',
        'alpha_3',
        'world_region_id',
        'notes',
        'wiki_url',
        'default_currency_id',
        'iso_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function regCountryContactCompanies()
    {
        return $this->hasMany(ContactCompany::class, 'reg_country_id', 'id');
    }

    public function countryAddresses()
    {
        return $this->hasMany(Address::class, 'country_id', 'id');
    }

    public function countryProvinces()
    {
        return $this->hasMany(Province::class, 'country_id', 'id');
    }

    public function countryOfBirthContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'country_of_birth_id', 'id');
    }

    public function currentCountryContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'current_country_id', 'id');
    }

    public function client1CountrySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_1_country_id', 'id');
    }

    public function client2CountrySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_2_country_id', 'id');
    }

    public function client3CountrySupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'client_3_country_id', 'id');
    }

    public function countriesCurrencies()
    {
        return $this->belongsToMany(Currency::class);
    }

    public function exportCountriesSupplierAudits()
    {
        return $this->belongsToMany(SupplierAudit::class);
    }

    public function world_region()
    {
        return $this->belongsTo(WorldRegion::class, 'world_region_id');
    }

    public function default_currency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
