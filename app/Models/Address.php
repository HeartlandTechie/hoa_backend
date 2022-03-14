<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'addresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

        'street_address',
        'street_name',
        'lot_number',
        'rental_flag',
        'rental_owner_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function address(): Attribute
    {


        return Attribute::make(

            get: fn ($value) => $this->street_address . " " . $this->street_name,
            //set: fn ($value) => strtolower($value),
        );
    }

    public function addressUsers()
    {
        return $this->hasMany(User::class, 'address_id', 'id');
    }

    public function addressStickers()
    {
        return $this->hasMany(Sticker::class, 'address_id', 'id');
    }

    public function addressBoats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function rental_owner()
    {
        return $this->belongsTo(User::class, 'rental_owner_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
