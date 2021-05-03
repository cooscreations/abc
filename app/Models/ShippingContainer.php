<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingContainer extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'shipping_containers';

    public static $searchable = [
        'container_number',
    ];

    protected $dates = [
        'est_loading_date',
        'actual_loading_date',
        'booking_date',
        'so_date',
        'si_date',
        'estimated_time_of_departure',
        'eta',
        'copy_bl_rec_date',
        'docs_sent_date',
        'bl_release_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'container_number',
        'order_id',
        'shipping_company_id',
        'est_loading_date',
        'actual_loading_date',
        'booking_date',
        'so_date',
        'si_date',
        'estimated_time_of_departure',
        'eta',
        'copy_bl_rec_date',
        'docs_sent_date',
        'bl_release_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function shipping_company()
    {
        return $this->belongsTo(ContactCompany::class, 'shipping_company_id');
    }

    public function getEstLoadingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEstLoadingDateAttribute($value)
    {
        $this->attributes['est_loading_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getActualLoadingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setActualLoadingDateAttribute($value)
    {
        $this->attributes['actual_loading_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBookingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBookingDateAttribute($value)
    {
        $this->attributes['booking_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSoDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSoDateAttribute($value)
    {
        $this->attributes['so_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSiDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSiDateAttribute($value)
    {
        $this->attributes['si_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEstimatedTimeOfDepartureAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEstimatedTimeOfDepartureAttribute($value)
    {
        $this->attributes['estimated_time_of_departure'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEtaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEtaAttribute($value)
    {
        $this->attributes['eta'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCopyBlRecDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCopyBlRecDateAttribute($value)
    {
        $this->attributes['copy_bl_rec_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocsSentDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDocsSentDateAttribute($value)
    {
        $this->attributes['docs_sent_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBlReleaseDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBlReleaseDateAttribute($value)
    {
        $this->attributes['bl_release_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
