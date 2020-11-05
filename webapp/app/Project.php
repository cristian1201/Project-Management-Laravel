<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'distance', 'gps_x', 'gps_y', 'percentage1', 'percentage2', 'percentage3', 'attachment', 'description'
    ];
//
    public function teams() {
        return $this->belongsToMany('App\ProjectTeam', 'project_teams', 'team_id', 'project_id');
    }
}
