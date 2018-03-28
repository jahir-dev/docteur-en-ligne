<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    public function medecins()
    {
        return $this->belongsToMany(Medecin::class)->withPivot('reponse')->withTimestamps();;
    }
}
