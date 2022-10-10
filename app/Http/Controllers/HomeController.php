<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Comment;

class HomeController extends Controller
{


    public function homeList(Request $request)
    {

        if ($request->s) {
            $search = explode(' ', $request->s);
            if (count($search) == 1) {
                $movies = Movie::where('title', 'like', '%'.$request->s.'%');
            }
            else {
                $movies = Movie::where('title', 'like', '%'.$search[0].'%'.$search[1].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[0].'%')
                ->orWhere('title', 'like', '%'.$search[1].'%');
            }
        }
        else {
            $movies = Movie::where('id', '>', 0);
        }

        // Sort
        if ($request->sort == 'rate_asc') {
            $movies->orderBy('rating');
        }
        else if ($request->sort == 'rate_desc') {
            $movies->orderBy('rating', 'desc');
        }
        else if ($request->sort == 'title_asc') {
            $movies->orderBy('title');
        }
        else if ($request->sort == 'title_desc') {
            $movies->orderBy('title', 'desc');
        }
        else if ($request->sort == 'price_asc') {
            $movies->orderBy('price');
        }
        else if ($request->sort == 'price_desc') {
            $movies->orderBy('price', 'desc');
        }
        
        return view('home.index', [
            'movies' => $movies->paginate(5)->withQueryString(),
            'sort' => $request->sort ?? '0',
            'sortSelect' => Movie::SORT_SELECT,
            's' => $request->s ?? '',
        ]);
    }

    public function rate(Request $request, Movie $movie)
    {
        $movie->rating_sum = $movie->rating_sum + $request->rate;
        $movie->rating_count ++;
        $movie->rating = $movie->rating_sum / $movie->rating_count;
        $movie->save();
        return redirect()->back();
    }

    public function addComment(Request $request, Movie $movie)
    {
        Comment::create([
            'movie_id' => $movie->id,
            'post' => $request->post
        ]);

        return redirect()->back();
    }




}