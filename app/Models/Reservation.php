<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const RESOURCE_SELECT = [
        'Clubhouse Upstairs'                   => 'Clubhouse Upstairs',
        'Clubhouse Downstairs'                 => 'Clubhouse Downstairs',
        'Clubhouse Downstairs + Pool'          => 'Clubhouse Downstairs + Pool',
        'Clubhouse Upstairs/Downstairs + Pool' => 'Clubhouse Upstairs/Downstairs + Pool',
    ];

    public $table = 'reservations';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'address_id',
        'contact_name',
        'resource',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
