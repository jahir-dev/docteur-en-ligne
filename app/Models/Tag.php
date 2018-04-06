<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    /*
    * The tags that belong to the speciality
    */
    public function specialites()
    {
        return $this->belongsToMany(Specialite::class)->withTimestamps();;
    }

    /*
    * The posts that belong to the tag
    */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();;
    }
    
}
