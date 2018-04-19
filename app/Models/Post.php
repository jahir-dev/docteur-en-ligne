<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    
    public function medecins()
    {
        return $this->belongsToMany(Medecin::class)->withPivot('reponse')->withTimestamps();;
    }

    public function internaute()
    {
        return $this->belongsTo(Internaute::class);
    }

}
