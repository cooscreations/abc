<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'expenses';

    protected $dates = [
        'entry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'expense_category_id',
        'entry_date',
        'amount',
        'description',
        'bank_account_id',
        'currency_id',
        'usd_amount',
        'exchange_rate_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function getEntryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEntryDateAttribute($value)
    {
        $this->attributes['entry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function exchange_rate()
    {
        return $this->belongsTo(CurrencyRate::class, 'exchange_rate_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
