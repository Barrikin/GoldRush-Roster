<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SopSignOff extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'sop_sign_offs';

    protected $dates = [
        'signed_off_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'officer_id',
        'sop_id',
        'signed_off_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id')->withTrashed();
    }

    public function sop()
    {
        return $this->belongsTo(Sop::class, 'sop_id')->withTrashed();
    }

    public function getSignedOffAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSignedOffAtAttribute($value)
    {
        $this->attributes['signed_off_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
