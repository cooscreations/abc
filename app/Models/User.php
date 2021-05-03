<?php

namespace App\Models;

use \DateTimeInterface;
use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use Auditable;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'nda_sign_date',
        'honesty_sign_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'nda_sign_date',
        'honesty_sign_date',
        'private_notes',
        'public_bio',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function userContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'user_id', 'id');
    }

    public function userAfaStaffs()
    {
        return $this->hasMany(AfaStaff::class, 'user_id', 'id');
    }

    public function reportsToAfaStaffs()
    {
        return $this->hasMany(AfaStaff::class, 'reports_to_id', 'id');
    }

    public function userOrderRoles()
    {
        return $this->hasMany(OrderRole::class, 'user_id', 'id');
    }

    public function managerDepartments()
    {
        return $this->hasMany(Department::class, 'manager_id', 'id');
    }

    public function inspectorSupplierAudits()
    {
        return $this->hasMany(SupplierAudit::class, 'inspector_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function relatedUsersDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getNdaSignDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setNdaSignDateAttribute($value)
    {
        $this->attributes['nda_sign_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHonestySignDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHonestySignDateAttribute($value)
    {
        $this->attributes['honesty_sign_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
