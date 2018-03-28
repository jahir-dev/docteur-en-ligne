<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    //
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }


    public function medecins(){
        return $this->hasMany(Medecin::class)->withTimestamps();
    }
}
