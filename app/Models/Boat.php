<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boat extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'boats';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function boatStickers()
    {
        return $this->hasMany(Sticker::class, 'boat_id', 'id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
