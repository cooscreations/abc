<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'currencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'symbol',
        'alpha_3',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function defaultCurrencyCountries()
    {
        return $this->hasMany(Country::class, 'default_currency_id', 'id');
    }

    public function currencyCurrencyRates()
    {
        return $this->hasMany(CurrencyRate::class, 'currency_id', 'id');
    }

    public function currencyExpenses()
    {
        return $this->hasMany(Expense::class, 'currency_id', 'id');
    }

    public function currencyIncomes()
    {
        return $this->hasMany(Income::class, 'currency_id', 'id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
