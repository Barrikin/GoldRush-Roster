<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Auditable, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'hired_on',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'LOA',
        '3' => 'Inactive',
        '4' => 'Resigned',
        '5' => 'Terminated',
    ];

    protected $fillable = [
        'call_sign',
        'name',
        'badge',
        'status',
        'phone_number',
        'hired_on',
        'time_zone',
        'remember_token',
        'password',
        'email',
        'email_verified_at',
        'rank_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getStrikePointsAttribute()
    {
        $disciplinary = Disciplinary::query()
            ->where('officer_id', $this->id)
            ->whereDate('expire_at', '>=', now())
            ->get()
            ->pluck('points');

        $points = 0;

        foreach($disciplinary as $disc) {
            $points += $disc;
        }

        return $points;
    }

    public function officerDisciplinaries()
    {
        return $this->hasMany(Disciplinary::class, 'officer_id', 'id');
    }

    public function officerComments()
    {
        return $this->hasMany(Comment::class, 'officer_id', 'id');
    }

    public function officerTrainings()
    {
        return $this->hasMany(Training::class, 'officer_id', 'id');
    }

    public function officerSopSignOffs()
    {
        return $this->hasMany(SopSignOff::class, 'officer_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getHiredOnAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHiredOnAttribute($value)
    {
        $this->attributes['hired_on'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
}
