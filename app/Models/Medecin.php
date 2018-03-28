<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{

    /**
     * Get the post that owns the comment.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    
    /**
     * Get the post that owns the comment.
     */
    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }
}
