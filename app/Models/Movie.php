<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'category_id'];

    const SORT_SELECT = [
        ['rate_asc', 'Rating 1 - 9'],
        ['rate_desc', 'Rating 9 - 1'],
        ['title_asc', 'A - Z'],
        ['title_desc', 'Z - A'],
        ['price_desc', 'Price Low first'],
        ['price_desc', 'Price High first'],
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getPhotos()
    {
        return $this->hasMany(MovieImage::class, 'movie_id', 'id');
    }

    public function addImages(?array $photos) : self
    {
        if ($photos) {
            $movieImage = [];
            $time = Carbon::now();
            foreach($photos as $photo) {
                $ext = $photo->getClientOriginalExtension();
                $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $file = $name. '-' . rand(100000, 999999). '.' . $ext;
                $photo->move(public_path().'/images', $file);
                $movieImage[] = [
                    'url' => asset('/images') . '/' . $file, 
                    'movie_id' => $this->id,
                    'created_at' => $time,
                    'updated_at' => $time
                ];
            }
            MovieImage::insert($movieImage);
        }
        return $this;
    }

    public function deleteImages(?array $photos) : self
    {
        if($photos) {
            $toDelete = MovieImage::whereIn('id', $photos)->get();
            foreach ($toDelete as $photo) {

               $file = public_path(). '/images/' .pathinfo($photo->url, PATHINFO_FILENAME). '.' . pathinfo($photo->url, PATHINFO_EXTENSION);
               if(file_exists($file)) {
                unlink($file);
               }
            }

            MovieImage::destroy($photos);
        }
        return $this;
    }

    public function lastImageUrl()
    {
        return $this->getPhotos()->orderBy('id', 'desc')->first()->url;
    }
    public function firstImageUrl()
    {
        return $this->getPhotos()->first()->url;
    }
}
