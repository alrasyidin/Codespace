<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\SpacePhoto;

class Space extends Model
{
    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(SpacePhoto::class, 'space_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Implemented Haversine Formula
    //Rute Terdekat tjoyy
    public function getSpaces($latitude, $longitude, $radius)
    {
        return $this->select('spaces.*')
            ->selectRaw(
                '(  6371 *
                    acos(cos(radians(?) ) *
                    cos(radians(latitude))*
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                    )
                ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->havingRaw("distance < ?", [$radius])
            ->orderBy('distance', 'asc');
    }
}
