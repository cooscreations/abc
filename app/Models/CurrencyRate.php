<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrencyRate extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'currency_rates';

    protected $dates = [
        'valid_until',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'usd_value',
        'currency_id',
        'valid_until',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function exchangeRateExpenses()
    {
        return $this->hasMany(Expense::class, 'exchange_rate_id', 'id');
    }

    public function exchangeRateIncomes()
    {
        return $this->hasMany(Income::class, 'exchange_rate_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function getValidUntilAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setValidUntilAttribute($value)
    {
        $this->attributes['valid_until'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
