<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Space;

class SpacePhoto extends Model
{
    protected $guarded = [];

    public function space()
    {
        return $this->hasMany(Space::class, 'space_id', 'id');
    }
}
