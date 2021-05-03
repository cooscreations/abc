<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'bank_accounts';

    public static $searchable = [
        'name',
        'beneficiary',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bank_name',
        'beneficiary',
        'company_id',
        'address_id',
        'account_number',
        'swift_code',
        'tlx_number',
        'default_comment_on_tnx',
        'internal_notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bankAccountExpenses()
    {
        return $this->hasMany(Expense::class, 'bank_account_id', 'id');
    }

    public function bankAccountIncomes()
    {
        return $this->hasMany(Income::class, 'bank_account_id', 'id');
    }

    public function afaBankAccountToPayOrders()
    {
        return $this->hasMany(Order::class, 'afa_bank_account_to_pay_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
