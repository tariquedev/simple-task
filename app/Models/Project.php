<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    function task(){
        return $this->hasMany(Task::class);
    }
}
