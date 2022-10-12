<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function getPivot()
    {
        return $this->hasMany(MovieTag::class, 'tag_id', 'id');
    }

    public function getMovies()
    {
        return $this->belongsToMany(Movie::class, 'movie_tags', 'tag_id', 'movie_id');
    }

}
