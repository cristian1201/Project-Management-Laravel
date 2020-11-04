<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'gps_x', 'gps_y', 'type',
    ];
//
    public function users() {
        return $this->hasMany('App\User', 'team_id');
    }
}
